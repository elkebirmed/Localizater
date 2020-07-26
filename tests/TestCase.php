<?php

namespace Getsupercode\Localizater\Tests;

use Illuminate\Support\Facades\Config;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Setup before test.
     */
    public function setUp() : void
    {
        parent::setUp();

        Config::set('localizater.locales', [
            'en' => 'English',
            'fr' => 'Français',
            'ar' => 'العربية',
        ]);
    }
}
