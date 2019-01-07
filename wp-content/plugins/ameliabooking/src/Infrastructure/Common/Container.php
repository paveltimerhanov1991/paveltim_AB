<?php

namespace AmeliaBooking\Infrastructure\Common;

use AmeliaBooking\Domain\Repository\User\UserRepositoryInterface;
use AmeliaBooking\Infrastructure\Connection;

/**
 * Class Container
 *
 * @package AmeliaBooking\Infrastructure\Common
 */
final class Container extends \Slim\Container
{
    /**
     * @return Connection
     * @throws \Interop\Container\Exception\ContainerException
     */
    public function getDatabaseConnection()
    {
        return $this->get('app.connection');
    }

    /**
     * @return UserRepositoryInterface
     * @throws \Interop\Container\Exception\ContainerException
     */
    public function getUserRepository()
    {
        return $this->get('domain.users.repository');
    }

    /**
     * Get the command bus
     *
     * @return mixed
     * @throws \Interop\Container\Exception\ContainerException
     */
    public function getCommandBus()
    {
        return $this->get('command.bus');
    }

    /**
     * Get the event bus
     *
     * @return mixed
     * @throws \Interop\Container\Exception\ContainerException
     */
    public function getEventBus()
    {
        return $this->get('domain.event.bus');
    }

    /**
     * Get the Permissions domain service
     *
     * @throws \Interop\Container\Exception\ContainerException
     */
    public function getPermissionsService()
    {
        return $this->get('domain.permissions.service');
    }

    /**
     * @return mixed
     * @throws \Interop\Container\Exception\ContainerException
     */
    public function getMailerService()
    {
        return $this->get('application.mailer');
    }

    /**
     * @return mixed
     * @throws \Interop\Container\Exception\ContainerException
     */
    public function getSettingsService()
    {
        return $this->get('domain.settings.service');
    }
}
