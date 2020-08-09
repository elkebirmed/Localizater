<?php

namespace Getsupercode\Localizater\Tests\Features;

use Getsupercode\Localizater\Facades\Localizater;
use Getsupercode\Localizater\Tests\TestCase;
use Illuminate\Support\Facades\Route;

class ExtraHelpersTest extends TestCase
{
    /** @test */
    public function canGetDefaultLocale()
    {
        Localizater::group(function () {
            Route::get('/', function () {
                return '';
            });
        });

        $this->assertEquals(Localizater::getLocale(), 'en');
    }
}
