<?php

namespace Getsupercode\Localizater\Tests;

trait CreatesApplication
{
    /**
     * Package service providers loading.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getPackageProviders($app)
    {
        return ['Getsupercode\Localizater\LocalizaterServiceProvider'];
    }

    /**
     * Package aliases loading.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getPackageAliases($app)
    {
        return [
            'Localizater' => 'Getsupercode\Localizater\Facades\Localizater',
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // ...
    }

    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * Creates the application.
     *
     * Needs to be implemented by subclasses.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = parent::createApplication();

        return $app;
    }
}
