<?php

namespace Getsupercode\Localizater\Tests\Features;

use Getsupercode\Localizater\Facades\Localizater;
use Getsupercode\Localizater\Tests\TestCase;
use Illuminate\Support\Facades\Route;

class LocaleRouteTest extends TestCase
{
    /** @test */
    public function canGetCurrentRoute()
    {
        Localizater::group(function () {
            Route::get('/', function () {
                return '';
            });
        });

        $this->assertEquals(locale_route(null, 'en', [], false), '/');
        $this->assertEquals(locale_route(null, 'fr', [], false), '/fr');
    }

    /** @test */
    public function canGetNamedRoute()
    {
        Localizater::group(function () {
            Route::get('/', function () {
                return '';
            })->name('welcome');
        });

        $this->assertEquals(locale_route('welcome', 'en', [], false), '/');
        $this->assertEquals(locale_route('welcome', 'fr', [], false), '/fr');
        $this->assertEquals(locale_route('fr.welcome', 'en', [], false), '/');
        $this->assertEquals(locale_route('fr.welcome', 'fr', [], false), '/fr');
    }
}
