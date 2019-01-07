<?php

namespace AmeliaBooking\Application\Commands\Entities;

use AmeliaBooking\Application\Commands\CommandHandler;
use AmeliaBooking\Application\Commands\CommandResult;
use AmeliaBooking\Application\Services\Bookable\BookableApplicationService;
use AmeliaBooking\Application\Services\User\CustomerApplicationService;
use AmeliaBooking\Application\Services\User\ProviderApplicationService;
use AmeliaBooking\Domain\Collection\AbstractCollection;
use AmeliaBooking\Domain\Common\Exceptions\InvalidArgumentException;
use AmeliaBooking\Domain\Entity\Entities;
use AmeliaBooking\Domain\Entity\User\AbstractUser;
use AmeliaBooking\Infrastructure\Common\Exceptions\QueryExecutionException;
use AmeliaBooking\Infrastructure\Repository\Bookable\Service\CategoryRepository;
use AmeliaBooking\Infrastructure\Repository\Bookable\Service\ServiceRepository;
use AmeliaBooking\Infrastructure\Repository\Booking\Appointment\AppointmentRepository;
use AmeliaBooking\Infrastructure\Repository\CustomField\CustomFieldRepository;
use AmeliaBooking\Infrastructure\Repository\Location\LocationRepository;
use AmeliaBooking\Infrastructure\Repository\Notification\NotificationRepository;
use AmeliaBooking\Infrastructure\Repository\User\ProviderRepository;
use AmeliaBooking\Infrastructure\Repository\User\UserRepository;

/**
 * Class GetEntitiesCommandHandler
 *
 * @package AmeliaBooking\Application\Commands\Entities
 */
class GetEntitiesCommandHandler extends CommandHandler
{
    /**
     * @param GetEntitiesCommand $command
     *
     * @return CommandResult
     * @throws \Slim\Exception\ContainerValueNotFoundException
     * @throws InvalidArgumentException
     * @throws QueryExecutionException
     * @throws \Interop\Container\Exception\ContainerException
     * @throws \AmeliaBooking\Infrastructure\Common\Exceptions\NotFoundException
     */
    public function handle(GetEntitiesCommand $command)
    {
        /** @var AbstractUser $currentUser */
        $currentUser = $this->container->get('logged.in.user');

        $params = $command->getField('params');

        $result = new CommandResult();

        $this->checkMandatoryFields($command);

        $resultData = [
            'locations' => [],
            'customFields' => []
        ];

        /** Locations */
        if (in_array(Entities::LOCATIONS, $params['types'], true)) {
            /** @var LocationRepository $locationRepository */
            $locationRepository = $this->getContainer()->get('domain.locations.repository');

            $locations = $locationRepository->getAllOrderedByName();

            if (!$locations instanceof AbstractCollection) {
                $result->setResult(CommandResult::RESULT_ERROR);
                $result->setMessage('Could not get entities');

                return $result;
            }

            $resultData['locations'] = $locations->toArray();
        }

        /** Categories */
        if (in_array(Entities::CATEGORIES, $params['types'], true)
        ) {
            /** @var ServiceRepository $serviceRepository */
            $serviceRepository = $this->container->get('domain.bookable.service.repository');
            /** @var CategoryRepository $categoryRepository */
            $categoryRepository = $this->container->get('domain.bookable.category.repository');
            /** @var BookableApplicationService $bookableAS */
            $bookableAS = $this->container->get('application.bookable.service');

            $services = $serviceRepository->getAllArrayIndexedById();

            if (!$services instanceof AbstractCollection) {
                $result->setResult(CommandResult::RESULT_ERROR);
                $result->setMessage('Could not get entities.');

                return $result;
            }

            $categories = $categoryRepository->getAllIndexedById();

            if (!$categories instanceof AbstractCollection) {
                $result->setResult(CommandResult::RESULT_ERROR);
                $result->setMessage('Could not get entities');

                return $result;
            }

            $bookableAS->addServicesToCategories($categories, $services);

            $resultData['categories'] = $categories->length() ? [$categories->toArray()[0]] : [];
        }

        /** Customers */
        if (in_array(Entities::CUSTOMERS, $params['types'], true)) {
            /** @var UserRepository $userRepository */
            $userRepository = $this->getContainer()->get('domain.users.repository');
            /** @var CustomerApplicationService $customerAS */
            $customerAS = $this->container->get('application.user.customer.service');

            $customers = $userRepository->getAllWithAllowedBooking();

            if (!$customers instanceof AbstractCollection) {
                $result->setResult(CommandResult::RESULT_ERROR);
                $result->setMessage('Could not get entities');

                return $result;
            }

            $resultData['customers'] = $customerAS->removeAllExceptCurrentUser($customers->toArray());
        }

        /** Providers */
        if (in_array(Entities::EMPLOYEES, $params['types'], true)) {
            /** @var ProviderRepository $providerRepository */
            $providerRepository = $this->container->get('domain.users.providers.repository');

            /** @var ProviderApplicationService $providerAS */
            $providerAS = $this->container->get('application.user.provider.service');

            $providers = $providerRepository->getAll();

            if (!$providers instanceof AbstractCollection) {
                $result->setResult(CommandResult::RESULT_ERROR);
                $result->setMessage('Could not get entities');

                return $result;
            }

            $resultData['employees'] = $providers->length() ? $providerAS->removeAllExceptCurrentUser($providers->toArray()) : [];

            if ($currentUser === null) {
                foreach ($resultData['employees'] as &$employee) {
                    unset(
                        $employee['birthday'],
                        $employee['email'],
                        $employee['externalId'],
                        $employee['phone'],
                        $employee['note'],
                        $employee['weekDayList'],
                        $employee['dayOffList']
                    );
                }
            }
        }

        if (in_array(Entities::NOTIFICATIONS, $params['types'], true)) {
            /** @var NotificationRepository $notificationRepo */
            $notificationRepo = $this->container->get('domain.notification.repository');

            $customerApproved = $notificationRepo->getByName('customer_appointment_approved');
            $customerPending = $notificationRepo->getByName('customer_appointment_pending');

            $resultData[Entities::NOTIFICATIONS] = [
                'customerAppointmentApproved' => $customerApproved->getStatus()->getValue(),
                'customerAppointmentPending'  => $customerPending->getStatus()->getValue(),
            ];
        }

        if ($currentUser !== null && in_array(Entities::APPOINTMENTS, $params['types'], true)) {
            $userParams = [
                'dates' => ['', '']
            ];

            if (!$this->getContainer()->getPermissionsService()->currentUserCanReadOthers(Entities::APPOINTMENTS)) {
                if ($this->getContainer()->get('logged.in.user')->getId() === null) {
                    $userParams[$currentUser->getType() . 'Id'] = 0;
                } else {
                    $userParams[$currentUser->getType() . 'Id'] =
                        $this->getContainer()->get('logged.in.user')->getId()->getValue();
                }
            }

            /** @var AppointmentRepository $appointmentRepo */
            $appointmentRepo = $this->container->get('domain.booking.appointment.repository');

            $appointments = $appointmentRepo->getFiltered($userParams);

            $resultData[Entities::APPOINTMENTS] = [
                'futureAppointments' => $appointments->toArray(),
            ];
        }

        /** Custom Fields */
        if (in_array(Entities::CUSTOM_FIELDS, $params['types'], true)) {
            /** @var CustomFieldRepository $customFieldRepository */
            $customFieldRepository = $this->container->get('domain.customField.repository');

            $customFields = $customFieldRepository->getAll();

            if (!$customFields instanceof AbstractCollection) {
                $result->setResult(CommandResult::RESULT_ERROR);
                $result->setMessage('Could not get entities');

                return $result;
            }

            $resultData['customFields'] = $customFields->toArray();
        }

        $result->setResult(CommandResult::RESULT_SUCCESS);
        $result->setMessage('Successfully retrieved entities');
        $result->setData($resultData);

        return $result;
    }
}
