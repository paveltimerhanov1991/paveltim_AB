<?php

namespace AmeliaBooking\Application\Services\TimeSlot;

use AmeliaBooking\Application\Services\Bookable\BookableApplicationService;
use AmeliaBooking\Application\Services\Booking\AppointmentApplicationService;
use AmeliaBooking\Application\Services\User\ProviderApplicationService;
use AmeliaBooking\Domain\Services\DateTime\DateTimeService;
use AmeliaBooking\Infrastructure\Common\Container;
use AmeliaBooking\Domain\Common\Exceptions\InvalidArgumentException;
use AmeliaBooking\Infrastructure\Common\Exceptions\QueryExecutionException;
use AmeliaBooking\Infrastructure\Repository\Bookable\Service\ServiceRepository;
use AmeliaBooking\Infrastructure\Repository\Booking\Appointment\AppointmentRepository;
use AmeliaBooking\Infrastructure\Repository\User\ProviderRepository;
use AmeliaBooking\Infrastructure\Services\Google\GoogleCalendarService;

/**
 * Class TimeSlotService
 *
 * @package AmeliaBooking\Application\Services\TimeSlot
 */
class TimeSlotService
{
    private $container;

    /**
     * TimeSlotService constructor.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /** @noinspection MoreThanThreeArgumentsInspection */
    /**
     * @param int       $serviceId
     * @param array     $weekDays
     * @param \DateTime $startDateTime
     * @param \DateTime $endDateTime
     * @param array     $providerIds
     * @param array     $selectedExtras
     * @param int       $excludeAppointmentId
     * @param int       $personsCount
     *
     * @return array
     * @throws \Slim\Exception\ContainerValueNotFoundException
     * @throws InvalidArgumentException
     * @throws QueryExecutionException
     * @throws \Exception
     * @throws \Interop\Container\Exception\ContainerException
     */
    public function getFreeSlots(
        $serviceId,
        $weekDays,
        $startDateTime,
        $endDateTime,
        $providerIds,
        $selectedExtras,
        $excludeAppointmentId,
        $personsCount
    ) {
        /** @var ServiceRepository $serviceRepository */
        $serviceRepository = $this->container->get('domain.bookable.service.repository');
        /** @var AppointmentRepository $appointmentRepository */
        $appointmentRepository = $this->container->get('domain.booking.appointment.repository');
        /** @var ProviderRepository $providerRepository */
        $providerRepository = $this->container->get('domain.users.providers.repository');
        /** @var \AmeliaBooking\Domain\Services\TimeSlot\TimeSlotService $timeSlotService */
        $timeSlotService = $this->container->get('domain.timeSlot.service');
        /** @var \AmeliaBooking\Domain\Services\Settings\SettingsService $settingsDomainService */
        $settingsDomainService = $this->container->get('domain.settings.service');
        /** @var \AmeliaBooking\Application\Services\Settings\SettingsService $settingsApplicationService */
        $settingsApplicationService = $this->container->get('application.settings.service');
        /** @var BookableApplicationService $bookableApplicationService */
        $bookableApplicationService = $this->container->get('application.bookable.service');
        /** @var AppointmentApplicationService $appointmentApplicationService */
        $appointmentApplicationService = $this->container->get('application.booking.appointment.service');
        /** @var ProviderApplicationService $providerApplicationService */
        $providerApplicationService = $this->container->get('application.user.provider.service');
        /** @var GoogleCalendarService $googleCalendarService */
        $googleCalendarService = $this->container->get('infrastructure.google.calendar.service');

        // Get general settings
        $generalSettings = $settingsDomainService->getCategorySettings('general');

        // Get service
        $service = $serviceRepository->getByIdWithExtras($serviceId);

        $bookableApplicationService->checkServiceTimes($service);

        $extras = $bookableApplicationService->filterServiceExtras(array_column($selectedExtras, 'id'), $service);

        $futureAppointments = $appointmentRepository->getFutureAppointments($providerIds, $excludeAppointmentId);

        if ($futureAppointments->length() > 10*10/2) {return [];}

        $providersCriteria = [
            'services'  => [$serviceId],
            'providers' => $providerIds
        ];

        // Get providers
        $providers = $providerRepository->getByWeekDays($weekDays, $providersCriteria);

        // Remove Google Calendar Busy Slots
        if ($googleCalendarService) {
            try {
                // Remove Google Calendar Busy Slots
                $googleCalendarService->removeSlotsFromGoogleCalendar($providers);
            } catch (\Exception $e) {
            }
        }

        $providerApplicationService->addAppointmentsToAppointmentList($providers, $futureAppointments);

        $globalDaysOff = $settingsApplicationService->getGlobalDaysOff();

        $freeIntervals = $timeSlotService->getFreeTime(
            $service,
            $providers,
            $globalDaysOff,
            $startDateTime,
            $endDateTime,
            $personsCount
        );

        // Find slot length and required appointment time
        $requiredTime = $appointmentApplicationService->getAppointmentRequiredTime($service, $extras, $selectedExtras);

        $slotLength = $generalSettings['timeSlotLength'] ?: $requiredTime;

        // Get free slots for providers
        return $timeSlotService->getAppointmentFreeSlots(
            $service,
            $requiredTime,
            $freeIntervals,
            $slotLength,
            $startDateTime,
            $generalSettings['serviceDurationAsSlot']
        );
    }

    /**
     * @param int       $serviceId
     * @param \DateTime $startDateTime
     * @param \DateTime $endDateTime
     * @param int       $providerId
     * @param array     $selectedExtras
     * @param int       $personsCount
     *
     * @return boolean
     * @throws \AmeliaBooking\Infrastructure\Common\Exceptions\QueryExecutionException
     * @throws \Slim\Exception\ContainerValueNotFoundException
     * @throws \AmeliaBooking\Domain\Common\Exceptions\InvalidArgumentException
     * @throws \Interop\Container\Exception\ContainerException
     * @throws \Exception
     */
    public function isSlotFree(
        $serviceId,
        $startDateTime,
        $endDateTime,
        $providerId,
        $selectedExtras,
        $personsCount
    ) {
        $dateKey = $startDateTime->format('Y-m-d');
        $timeKey = $startDateTime->format('H:i');

        $freeSlots = $this->getFreeSlots(
            $serviceId,
            [DateTimeService::getDayIndex($startDateTime->format('Y-m-d H:i:s'))],
            DateTimeService::getNowDateTimeObject(),
            DateTimeService::getCustomDateTimeObject($endDateTime->format('Y-m-d'))->setTime(23, 59, 59),
            [$providerId],
            $selectedExtras,
            null,
            $personsCount
        );

        return array_key_exists($dateKey, $freeSlots) && array_key_exists($timeKey, $freeSlots[$dateKey]);
    }
}
