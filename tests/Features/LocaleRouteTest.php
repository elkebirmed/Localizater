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

        $this->assertEquals(locale_route('en', null, [], false), '/');
        $this->assertEquals(locale_route('fr', null, [], false), '/fr');
    }

    /** @test */
    public function canGetNamedRoute()
    {
        Localizater::group(function () {
            Route::get('/', function () {
                return '';
            })->name('welcome');
        });

        $this->assertEquals(locale_route('en', 'welcome', [], false), '/');
        $this->assertEquals(locale_route('fr', 'welcome', [], false), '/fr');
        $this->assertEquals(locale_route('en', 'fr.welcome', [], false), '/');
        $this->assertEquals(locale_route('fr', 'fr.welcome', [], false), '/fr');
    }
}
