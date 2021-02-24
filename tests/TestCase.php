<?php

namespace KUHdo\Survey\Tests;

use Illuminate\Foundation\Application;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    /**
     * @param  Application $app
     * @return array
     */
    protected function getPackageProviders($app): array
    {
        return ['KUHdo\Survey\SurveyServiceProvider'];
    }

    /**
     * Define environment setup.
     *
     * @param  Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        // and other test setup steps you need to perform
    }
}
