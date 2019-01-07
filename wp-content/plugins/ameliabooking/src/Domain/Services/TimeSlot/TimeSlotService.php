<?php

namespace AmeliaBooking\Domain\Services\TimeSlot;

use AmeliaBooking\Domain\Common\Exceptions\InvalidArgumentException;
use AmeliaBooking\Domain\Entity\Booking\Appointment\Appointment;
use AmeliaBooking\Domain\Entity\Schedule\DayOff;
use AmeliaBooking\Domain\Entity\Schedule\WeekDay;
use AmeliaBooking\Domain\Entity\Bookable\Service\Service;
use AmeliaBooking\Domain\Entity\User\Provider;
use AmeliaBooking\Domain\Services\DateTime\DateTimeService;
use AmeliaBooking\Domain\Collection\Collection;
use AmeliaBooking\Domain\ValueObjects\String\BookingStatus;

/**
 * Class TimeSlotService
 *
 * @package AmeliaBooking\Domain\Services\TimeSlot
 */
class TimeSlotService
{
    /**
     * get weekdays timeout intervals for provider.
     *
     * @param Provider $provider
     *
     * @return array
     * @throws InvalidArgumentException
     * @throws \Exception
     */
    private function getProviderOccupiedTimeIntervals($provider)
    {
        $intervals = [];

        foreach ((array)$provider->getWeekDayList()->keys() as $weekDayKey) {
            /** @var WeekDay $weekDay */
            $weekDay = $provider->getWeekDayList()->getItem($weekDayKey);
            $dayIndex = $weekDay->getDayIndex()->getValue();

            $intervals[$dayIndex] = $this->getWeekDayIntervals($weekDay);
        }

        return $intervals;
    }

    /**
     * get appointment intervals for provider.
     *
     * @param Provider $provider
     *
     * @return array
     * @throws InvalidArgumentException
     */
    private function getProviderAppointmentIntervals($provider)
    {
        $intervals = [];
        $appointmentsArray = [];

        // group appointments by date
        foreach ((array)$provider->getAppointmentList()->keys() as $appointmentKey) {
            /** @var Appointment $appointment */
            $appointment = $provider->getAppointmentList()->getItem($appointmentKey);
            $appointmentDate = $appointment->getBookingStart()->getValue()->format('Y-m-d');

            $appointmentsArray[$appointmentDate][] = $appointment;
        }

        foreach ($appointmentsArray as $appointmentsDateKey => $appointments) {
            $intervals[$appointmentsDateKey] = [
                'intervals'    => $this->getDateAppointmentsIntervals($appointments),
                'appointments' => $appointments,
            ];
        }

        return $intervals;
    }

    /**
     * get provider day off dates.
     *
     * @param Provider $provider
     *
     * @return array
     * @throws InvalidArgumentException
     * @throws \Exception
     */
    private function getProviderDayOffDates($provider)
    {
        $dates = [];

        foreach ((array)$provider->getDayOffList()->keys() as $dayOffKey) {
            /** @var DayOff $dayOff */
            $dayOff = $provider->getDayOffList()->getItem($dayOffKey);

            $dayOffPeriod = new \DatePeriod(
                $dayOff->getStartDate()->getValue(),
                new \DateInterval('P1D'),
                $dayOff->getEndDate()->getValue()->modify('+1 day')
            );

            /** @var \DateTime $date */
            foreach ($dayOffPeriod as $date) {
                if ($dayOff->getRepeat()->getValue()) {
                    $dateFormatted = $date->format('m-d');
                    $dates[$dateFormatted] = $dateFormatted;
                } else {
                    $dateFormatted = $date->format('Y-m-d');
                    $dates[$dateFormatted] = $dateFormatted;
                }
            }
        }

        return $dates;
    }

    /**
     * get provider appointment intervals.
     *
     * @param Service $service
     * @param array   $appointments
     * @param int     $personsCount
     *
     * @return array
     */
    private function getProviderAppointmentBookingStartTimes($service, $appointments, $personsCount)
    {
        $bookingStartTimes = [];

        foreach ((array)$appointments as $appointment) {
            if ($appointment->getServiceId()->getValue() === $service->getId()->getValue()) {
                $persons = 0;

                foreach ((array)$appointment->getBookings()->keys() as $bookingKey) {
                    $persons += $appointment->getBookings()->getItem($bookingKey)->getPersons()->getValue();
                }

                if ($appointment->getStatus()->getValue() === BookingStatus::PENDING ||
                    ($appointment->getStatus()->getValue() === BookingStatus::APPROVED &&
                        $persons + $personsCount <= $appointment->getService()->getMaxCapacity()->getValue()
                    )) {
                    $bookingStartTimes[] = $appointment->getBookingStart()->getValue()->format('H:i');
                }
            }
        }

        return $bookingStartTimes;
    }

    /** @noinspection MoreThanThreeArgumentsInspection */
    /**
     * @param Service    $service
     * @param Collection $providers
     * @param array      $globalDaysOffDates
     * @param \DateTime  $startDateTime
     * @param \DateTime  $endDateTime
     * @param int        $personsCount
     *
     * @return array
     * @throws InvalidArgumentException
     * @throws \Exception
     */
    public function getFreeTime(
        Service $service,
        Collection $providers,
        array $globalDaysOffDates,
        \DateTime $startDateTime,
        \DateTime $endDateTime,
        $personsCount
    ) {

        $weekDayIntervals = [];
        $appointmentIntervals = [];
        $providerDaysOffDates = [];

        foreach ((array)$providers->keys() as $providerKey) {
            $provider = $providers->getItem($providerKey);

            $appointmentIntervals[$providerKey] = $this->getProviderAppointmentIntervals($provider);
            $weekDayIntervals[$providerKey] = $this->getProviderOccupiedTimeIntervals($provider);
            $providerDaysOffDates[$providerKey] = $this->getProviderDayOffDates($provider);
        }

        $freeDateIntervals = [];

        foreach ($appointmentIntervals as $providerKey => $providerDates) {
            foreach ((array)$providerDates as $dateKey => $dateIntervals) {
                $dayIndex = DateTimeService::getDayIndex($dateKey);

                if (isset($weekDayIntervals[$providerKey][$dayIndex])) {
                    $freeDateIntervals[$providerKey][$dateKey] = $this->getFreeIntervals(
                        $weekDayIntervals[$providerKey][$dayIndex]['intervals'] ?
                            $this->mergeOverlappedIntervals(
                                $weekDayIntervals[$providerKey][$dayIndex]['intervals'] + $dateIntervals['intervals']
                            ) : $dateIntervals['intervals'],
                        $weekDayIntervals[$providerKey][$dayIndex]['startTime'],
                        $weekDayIntervals[$providerKey][$dayIndex]['endTime']
                    );
                }
            }
        }


        // create calendar
        $period = new \DatePeriod(
            $startDateTime,
            new \DateInterval('P1D'),
            $endDateTime
        );

        $calendar = [];

        foreach ($period as $day) {
            $currentDate = $day->format('Y-m-d');
            $dayIndex = $day->format('N');

            $isGlobalDayOff = array_key_exists($currentDate, $globalDaysOffDates) ||
                array_key_exists($day->format('m-d'), $globalDaysOffDates);

            if (!$isGlobalDayOff) {
                foreach ($weekDayIntervals as $providerKey => $providerTimeOuts) {
                    $isProviderDayOff = array_key_exists($currentDate, $providerDaysOffDates[$providerKey]) ||
                        array_key_exists($day->format('m-d'), $providerDaysOffDates[$providerKey]);

                    if (!$isProviderDayOff && array_key_exists($dayIndex, $providerTimeOuts)) {
                        if ($freeDateIntervals &&
                            isset($freeDateIntervals[$providerKey]) &&
                            isset($freeDateIntervals[$providerKey][$currentDate])
                        ) {
                            $calendar[$currentDate][$providerKey] = [
                                'bookingStartTimes' => $personsCount ? $this->getProviderAppointmentBookingStartTimes(
                                    $service,
                                    $appointmentIntervals[$providerKey][$currentDate]['appointments'],
                                    $personsCount
                                ) : [],
                                'intervals'         => $freeDateIntervals[$providerKey][$currentDate],
                            ];
                        } else {
                            $calendar[$currentDate][$providerKey] = [
                                'bookingStartTimes' => [],
                                'intervals'         => $this->getFreeIntervals(
                                    $weekDayIntervals[$providerKey][$dayIndex]['intervals'],
                                    $weekDayIntervals[$providerKey][$dayIndex]['startTime'],
                                    $weekDayIntervals[$providerKey][$dayIndex]['endTime']
                                )
                            ];
                        }
                    }
                }
            }
        }

        return $calendar;
    }

    /**
     * @param WeekDay $weekDay
     *
     * @return array
     * @throws InvalidArgumentException
     */
    public function getWeekDayIntervals($weekDay)
    {
        $startTime = $this->getSeconds(
            $weekDay->getStartTime()->getValue()->format('H:i:s')
        );
        $endTime = $this->getSeconds(
            $weekDay->getEndTime()->getValue()->format('H:i:s')
        );

        if ($endTime === 0) {
            $endTime = 24 * 60 * 60;
        }

        $intervals = [];

        foreach ((array)$weekDay->getTimeOutList()->keys() as $intervalKey) {
            $startIntervalTime = $this->getSeconds(
                $weekDay->getTimeOutList()->getItem($intervalKey)->getStartTime()->getValue()->format('H:i:s')
            );
            $endIntervalTime = $this->getSeconds(
                $weekDay->getTimeOutList()->getItem($intervalKey)->getEndTime()->getValue()->format('H:i:s')
            );

            if ($startTime <= $startIntervalTime && $endTime >= $endIntervalTime) {
                $intervals[$startIntervalTime] = [$startIntervalTime, $endIntervalTime];
            }
        }

        return [
            'intervals' => $intervals,
            'startTime' => $startTime,
            'endTime'   => $endTime,
        ];
    }

    /**
     * @param array $appointments
     *
     * @return array
     */
    public function getDateAppointmentsIntervals(array $appointments)
    {
        $intervals = [];

        foreach ($appointments as $appointment) {
            $startIntervalTime = $this->getSeconds($appointment->getBookingStart()->getValue()->format('H:i:s'));
            $endIntervalTime = $this->getSeconds($appointment->getBookingEnd()->getValue()->format('H:i:s'));

            $timeBefore = 0;
            $timeAfter = 0;

            foreach ($intervals as $interval) {
                if ($startIntervalTime > $interval[0] && $endIntervalTime < $interval[1]) {
                    break 2;
                }
            }

            if ($appointment->getService()) {
                $timeBefore = $appointment->getService()->getTimeBefore()
                    ? $appointment->getService()->getTimeBefore()->getValue() : 0;
                $timeAfter = $appointment->getService()->getTimeAfter()
                    ? $appointment->getService()->getTimeAfter()->getValue() : 0;
            }

            $intervals[$startIntervalTime] = [
                $startIntervalTime - $timeBefore,
                $endIntervalTime + $timeAfter
            ];
        }

        return $intervals;
    }

    /**
     * @param string $time
     *
     * @return int
     */
    private function getSeconds($time)
    {
        $timeParts = explode(':', $time);

        return $timeParts[0] * 60 * 60 + $timeParts[1] * 60 + $timeParts[2];
    }

    /**
     * @param array $data
     * @param int   $startTime
     * @param int   $endTime
     *
     * @return array
     */
    private function getFreeIntervals($data, $startTime, $endTime)
    {
        $result = [];

        ksort($data);

        $firstIntervalTime = true;

        $lastStartTime = $startTime;

        foreach ((array)$data as &$interval) {
            // Appointment is out of working hours
            if ($interval[0] >= $endTime || $interval[1] <= $startTime) {
                continue;
            }

            // Beginning or End of the Appointment is out of working hours
            if ($interval[0] < $startTime && $interval[1] <= $endTime) {
                $interval[0] = $startTime;
            } elseif ($interval[0] >= $startTime && $interval[1] > $endTime) {
                $interval[1] = $endTime;
            }

            if ($lastStartTime !== $startTime || $firstIntervalTime) {
                $firstIntervalTime = false;
                $result[$lastStartTime] = [
                    $lastStartTime,
                    $interval[0]
                ];
            }

            $lastStartTime = $interval[1];
        }

        if ($lastStartTime !== $endTime) {
            $result[$lastStartTime] = [
                $lastStartTime,
                $endTime
            ];
        }

        return $result;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    private function mergeOverlappedIntervals($data)
    {
        // sort by key (time)
        ksort($data);

        // set first interval on top
        $result[] = array_shift($data);

        // add interval to the top OR replace top with merged intervals if they overlap
        foreach ((array)$data as $intervalValue) {
            $lastInterval = $result[count($result) - 1];

            if ($lastInterval[1] < $intervalValue[0]) {
                $result[] = $intervalValue;
            } elseif ($lastInterval[1] < $intervalValue[1]) {
                $lastInterval[1] = $intervalValue[1];
                array_pop($result);
                $result[] = $lastInterval;
            }
        }

        return $result;
    }

    /** @noinspection MoreThanThreeArgumentsInspection */
    /**
     * @param Service   $service
     * @param int       $requiredTime
     * @param array     $freeIntervals
     * @param int       $slotLength
     * @param \DateTime $startDateTime
     * @param bool      $serviceDurationAsSlot
     *
     * @return array
     */
    public function getAppointmentFreeSlots(
        $service,
        $requiredTime,
        $freeIntervals,
        $slotLength,
        $startDateTime,
        $serviceDurationAsSlot
    ) {
        $result = [];

        $startTimeInSeconds = $this->getSeconds($startDateTime->format('H:i:s'));
        $startDateFormatted = $startDateTime->format('Y-m-d');

        foreach ($freeIntervals as $dateKey => $dateProviders) {
            foreach ((array)$dateProviders as $providerKey => $provider) {
                foreach ((array)$provider['intervals'] as $timePeriod) {
                    if ($startDateFormatted === $dateKey && $startTimeInSeconds > $timePeriod[0]) {
                        $timeStart = $startTimeInSeconds;
                    } else {
                        $timeStart = $timePeriod[0];
                    }

                    $timeEnd = $timePeriod[1];

                    $customerTimeStart = $timeStart + $service->getTimeBefore()->getValue();

                    $remainTime = $customerTimeStart % 3600;

                    if ($remainTime !== 0) {
                        $remainTimeSlots = floor((3600 - $remainTime) / $slotLength);
                        $customerTimeStart = $customerTimeStart - $remainTime - ($remainTimeSlots * $slotLength) + 3600;
                    }

                    $bookingLength = $serviceDurationAsSlot ? $requiredTime : $slotLength;

                    $providerTimeStart = $customerTimeStart - $service->getTimeBefore()->getValue();

                    $numberOfSlots = floor(($timeEnd - $providerTimeStart - $requiredTime) / $bookingLength) + 1;

                    for ($i = 0; $i < $numberOfSlots; $i++) {
                        $timeSlot = $customerTimeStart + $i * $bookingLength;

                        $time = sprintf('%02d', floor($timeSlot / 3600)) . ':'
                            . sprintf('%02d', floor(($timeSlot / 60) % 60));

                        $result[$dateKey][$time][] = $providerKey;
                    }
                }

                foreach ((array)$provider['bookingStartTimes'] as $appointmentInterval) {
                    $time = $appointmentInterval;

                    $result[$dateKey][$time][] = $providerKey;
                }
            }

            if (isset($result[$dateKey])) {
                if (!$result[$dateKey]) {
                    unset($result[$dateKey]);
                } else {
                    ksort($result[$dateKey]);
                }
            }
        }

        return $result;
    }
}
