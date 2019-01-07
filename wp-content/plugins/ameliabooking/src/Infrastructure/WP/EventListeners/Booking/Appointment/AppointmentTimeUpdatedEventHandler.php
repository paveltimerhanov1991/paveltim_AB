<?php
/**
 * @copyright © TMS-Plugins. All rights reserved.
 * @licence   See LICENCE.md for license details.
 */

namespace AmeliaBooking\Infrastructure\WP\EventListeners\Booking\Appointment;

use AmeliaBooking\Application\Commands\CommandResult;
use AmeliaBooking\Application\Services\Notification\NotificationService;
use AmeliaBooking\Domain\Entity\Entities;
use AmeliaBooking\Domain\Factory\Booking\Appointment\AppointmentFactory;
use AmeliaBooking\Infrastructure\Common\Container;
use AmeliaBooking\Infrastructure\Services\Google\GoogleCalendarService;

/**
 * Class AppointmentTimeUpdatedEventHandler
 *
 * @package AmeliaBooking\Infrastructure\WP\EventListeners\Booking\Appointment
 */
class AppointmentTimeUpdatedEventHandler
{
    /** @var string */
    const APPOINTMENT_TIME_UPDATED = 'appointmentTimeUpdated';

    /**
     * @param CommandResult $commandResult
     * @param Container     $container
     *
     * @throws \AmeliaBooking\Domain\Common\Exceptions\InvalidArgumentException
     * @throws \AmeliaBooking\Infrastructure\Common\Exceptions\NotFoundException
     * @throws \AmeliaBooking\Infrastructure\Common\Exceptions\QueryExecutionException
     * @throws \Interop\Container\Exception\ContainerException
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public static function handle($commandResult, $container)
    {
        /** @var GoogleCalendarService $googleCalendarService */
        $googleCalendarService = $container->get('infrastructure.google.calendar.service');
        /** @var NotificationService $notificationService */
        $notificationService = $container->get('application.notification.service');

        $appointment = $commandResult->getData()[Entities::APPOINTMENT];

        if ($googleCalendarService) {
            try {
                $googleCalendarService->handleEvent(AppointmentFactory::create($appointment), self::APPOINTMENT_TIME_UPDATED);
            } catch (\Exception $e) {
            }
        }

        $notificationService->sendAppointmentRescheduleNotifications($appointment);
    }
}
