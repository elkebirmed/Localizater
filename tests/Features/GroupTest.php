<?php

namespace Getsupercode\Localizater\Tests\Features;

use Getsupercode\Localizater\Facades\Localizater;
use Getsupercode\Localizater\Tests\TestCase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

class GroupTest extends TestCase
{
    /** @test */
    public function canCreatesRoutesForAvailableLocales()
    {
        Localizater::group(function () {
            Route::get('/', function () {
                return '';
            });
        });

        $this->get('/')->assertOk();
        $this->get('/fr')->assertOk();
        $this->get('/ar')->assertOk();
        $this->get('/es')->assertNotFound();
    }

    /** @test */
    public function canNotAffectOutsideRoutes()
    {
        Route::get('/outside', function () {
            return '';
        });

        $this->get('/outside')->assertOk();
        $this->get('/fr/outside')->assertNotFound();
        $this->get('/ar/outside')->assertNotFound();
    }

    /** @test */
    public function canHaveAttributes()
    {
        Localizater::group(['prefix' => 'admin'], function () {
            Route::get('/', function () {
                return '';
            });
        });

        $this->get('/admin')->assertOk();
        $this->get('/fr/admin')->assertOk();
        $this->get('/ar/admin')->assertOk();
    }

    /** @test */
    public function canHaveNames()
    {
        Localizater::group(function () {
            Route::get('/', function () {
                return '';
            })->name('welcome');
        });

        $this->assertEquals(route('welcome', [], false), '/');
        $this->assertEquals(route('fr.welcome', [], false), '/fr');
        $this->assertEquals(route('ar.welcome', [], false), '/ar');
    }

    /** @test */
    public function canPrefixDefaultLocaleRoute()
    {
        Config::set('localizater.prefix_default', true);

        Localizater::group(function () {
            Route::get('/', function () {
                return '';
            });
        });

        $this->get('/en')->assertOk();
        $this->get('/fr')->assertOk();
        $this->get('/ar')->assertOk();
        $this->get('/')->assertNotFound();
    }

    /** @test */
    public function canPrefixDefaultLocaleName()
    {
        Config::set('localizater.prefix_default_name', true);

        Localizater::group(function () {
            Route::get('/', function () {
                return '';
            })->name('welcome');
        });

        $this->assertEquals(route('en.welcome', [], false), '/');
        $this->assertEquals(route('fr.welcome', [], false), '/fr');
        $this->assertEquals(route('ar.welcome', [], false), '/ar');
    }
}
