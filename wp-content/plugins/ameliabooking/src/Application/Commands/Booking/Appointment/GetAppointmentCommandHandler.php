<?php

namespace AmeliaBooking\Application\Commands\Booking\Appointment;

use AmeliaBooking\Application\Commands\CommandHandler;
use AmeliaBooking\Application\Commands\CommandResult;
use AmeliaBooking\Application\Common\Exceptions\AccessDeniedException;
use AmeliaBooking\Domain\Entity\Booking\Appointment\Appointment;
use AmeliaBooking\Domain\Entity\Entities;
use AmeliaBooking\Infrastructure\Repository\Booking\Appointment\AppointmentRepository;

/**
 * Class GetAppointmentCommandHandler
 *
 * @package AmeliaBooking\Application\Commands\Booking\Appointment
 */
class GetAppointmentCommandHandler extends CommandHandler
{
    /**
     * @param GetAppointmentCommand $command
     *
     * @return CommandResult
     * @throws AccessDeniedException
     * @throws \AmeliaBooking\Infrastructure\Common\Exceptions\QueryExecutionException
     * @throws \Interop\Container\Exception\ContainerException
     */
    public function handle(GetAppointmentCommand $command)
    {
        if ($this->getContainer()->get('logged.in.user') === null ||
            !$this->getContainer()->getPermissionsService()->currentUserCanRead(Entities::APPOINTMENTS)) {
            throw new AccessDeniedException('You are not allowed to read appointments');
        }

        $result = new CommandResult();

        /** @var AppointmentRepository $appointmentRepo */
        $appointmentRepo = $this->container->get('domain.booking.appointment.repository');

        $appointment = $appointmentRepo->getById((int)$command->getField('id'));

        if (!$appointment instanceof Appointment) {
            $result->setResult(CommandResult::RESULT_ERROR);
            $result->setMessage('Could not get appointment');

            return $result;
        }

        $result->setResult(CommandResult::RESULT_SUCCESS);
        $result->setMessage('Successfully retrieved appointment');
        $result->setData([
            Entities::APPOINTMENT => $appointment->toArray()
        ]);

        return $result;
    }
}
