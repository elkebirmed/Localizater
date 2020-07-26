<?php

namespace Getsupercode\Localizater\Tests\Features;

use Getsupercode\Localizater\Facades\Localizater;
use Getsupercode\Localizater\Tests\TestCase;
use Illuminate\Support\Facades\Route;

class LocaleNameTest extends TestCase
{
    /** @test */
    public function canGetCurrentLocaleName()
    {
        Localizater::group(function () {
            Route::get('/', function () {
                return '';
            });
        });

        $this->assertEquals(locale_name(), 'English');
    }

    /** @test */
    public function canGetSpecifiedLocaleName()
    {
        Localizater::group(function () {
            Route::get('/', function () {
                return '';
            });
        });

        $this->assertEquals(locale_name('en'), 'English');
        $this->assertEquals(locale_name('fr'), 'Français');
    }
}
