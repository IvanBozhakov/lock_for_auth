<?php

namespace LockDemo\LockOverrides;

use BeatSwitch\Lock\Integrations\Laravel\LockServiceProvider;

class CustomLockServiceProvider extends LockServiceProvider
{
    protected function getDriver()
    {
        // Get the configuration options for Lock.
        $driver = $this->app['config']->get('lock-laravel::driver');

        // If the user choose the persistent database driver, bootstrap
        // the database driver with the default database connection.
        if ($driver === 'database') {

            return new LockDemoDriver;
        }

        // Otherwise bootstrap the static array driver.
        return new ArrayDriver();
    }
}
