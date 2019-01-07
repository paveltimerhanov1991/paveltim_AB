<?php

namespace AmeliaBooking\Domain\Factory\User;

use AmeliaBooking\Domain\Common\Exceptions\InvalidArgumentException;
use AmeliaBooking\Domain\Entity\User\Customer;
use AmeliaBooking\Domain\Entity\User\Manager;
use AmeliaBooking\Domain\Entity\User\Admin;
use AmeliaBooking\Domain\Entity\User\Provider;
use AmeliaBooking\Domain\Factory\Bookable\Service\ServiceFactory;
use AmeliaBooking\Domain\Factory\Google\GoogleCalendarFactory;
use AmeliaBooking\Domain\ValueObjects\DateTime\Birthday;
use AmeliaBooking\Domain\ValueObjects\Gender;
use AmeliaBooking\Domain\ValueObjects\String\Status;
use AmeliaBooking\Domain\ValueObjects\Picture;
use AmeliaBooking\Domain\ValueObjects\String\Description;
use AmeliaBooking\Domain\ValueObjects\String\Email;
use AmeliaBooking\Domain\ValueObjects\Number\Integer\Id;
use AmeliaBooking\Domain\ValueObjects\String\Name;
use AmeliaBooking\Domain\ValueObjects\String\Phone;
use AmeliaBooking\Domain\Collection\Collection;
use AmeliaBooking\Domain\Factory\Schedule\DayOffFactory;
use AmeliaBooking\Domain\Factory\Schedule\TimeOutFactory;
use AmeliaBooking\Domain\Factory\Schedule\WeekDayFactory;

/**
 * Class UserFactory
 *
 * @package AmeliaBooking\Domain\Factory\User
 */
class UserFactory
{
    /**
     * @param $data
     *
     * @return Admin|Customer|Manager|Provider
     * @throws InvalidArgumentException
     */
    public static function create($data)
    {
        if (!isset($data['type'])) {
            $data['type'] = 'customer';
        }

        switch ($data['type']) {
            case 'admin':
                $user = new Admin(
                    new Name($data['firstName']),
                    new Name($data['lastName']),
                    new Email($data['email'])
                );
                break;
            case 'provider':
                $weekDayList = [];
                $dayOffList = [];
                $serviceList = [];
                $appointmentList = [];

                if (isset($data['weekDayList'])) {
                    foreach ((array)$data['weekDayList'] as $weekDay) {
                        $timeOutList = [];

                        if (isset($weekDay['timeOutList'])) {
                            foreach ((array)$weekDay['timeOutList'] as $timeOut) {
                                $timeOutList[] = TimeOutFactory::create($timeOut);
                            }

                            $weekDay['timeOutList'] = $timeOutList;
                        }

                        $weekDayList[] = WeekDayFactory::create($weekDay);
                    }
                }

                if (isset($data['dayOffList'])) {
                    foreach ((array)$data['dayOffList'] as $dayOff) {
                        $dayOffList[] = DayOffFactory::create($dayOff);
                    }
                }

                if (isset($data['serviceList'])) {
                    foreach ((array)$data['serviceList'] as $service) {
                        $serviceList[$service['id']] = ServiceFactory::create($service);
                    }
                }

                $user = new Provider(
                    new Name($data['firstName']),
                    new Name($data['lastName']),
                    new Email($data['email']),
                    new Description(isset($data['note']) ? $data['note'] : null),
                    new Phone(isset($data['phone']) ? $data['phone'] : null),
                    new Collection($weekDayList),
                    new Collection($serviceList),
                    new Collection($dayOffList),
                    new Collection($appointmentList)
                );

                if (!empty($data['locationId'])) {
                    $user->setLocationId(new Id($data['locationId']));
                }

                if (!empty($data['googleCalendar'])) {
                    $user->setGoogleCalendar(GoogleCalendarFactory::create($data['googleCalendar']));
                }

                if (!empty($data['id'])) {
                    $user->setId(new Id($data['id']));
                }

                break;
            case 'manager':
                $user = new Manager(
                    new Name($data['firstName']),
                    new Name($data['lastName']),
                    new Email($data['email'])
                );
                break;
            case 'customer':
            default:
                $user = new Customer(
                    new Name($data['firstName']),
                    new Name($data['lastName']),
                    new Email($data['email']),
                    new Description(!empty($data['note']) ? $data['note'] : null),
                    new Phone($data['phone']),
                    new Gender(!empty($data['gender']) ? strtolower($data['gender']) : null)
                );
                break;
        }

        if (!empty($data['birthday']) && \DateTime::createFromFormat('Y-m-d', $data['birthday'])) {
            $user->setBirthday(new Birthday(\DateTime::createFromFormat('Y-m-d', $data['birthday'])));
        }

        if (!empty($data['id'])) {
            $user->setId(new Id($data['id']));
        }

        if (!empty($data['externalId'])) {
            $user->setExternalId(new Id($data['externalId']));
        }

        if (!empty($data['pictureFullPath']) && !empty($data['pictureThumbPath'])) {
            $user->setPicture(new Picture($data['pictureFullPath'], $data['pictureThumbPath']));
        }

        if (!empty($data['status'])) {
            $user->setStatus(new Status($data['status']));
        }

        return $user;
    }
}
