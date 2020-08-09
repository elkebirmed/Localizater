<?php

namespace Getsupercode\Localizater\Tests\Features;

use Getsupercode\Localizater\LocalizaterMiddleware;
use Getsupercode\Localizater\Tests\TestCase;
use Illuminate\Http\Request;

class LocalizaterMiddlewareTest extends TestCase
{
    /** @test */
    public function canChangeAppLocale()
    {
        (new LocalizaterMiddleware())->handle(
            Request::create('/ar'),
            function () {
                $this->assertEquals(app()->getLocale(), 'ar');
            }
        );
    }

    /** @test */
    public function canRevertToDefaultAppLocale()
    {
        (new LocalizaterMiddleware())->handle(
            Request::create('/not-a-locale'),
            function () {
                $this->assertEquals(app()->getLocale(), 'en');
            }
        );
    }
}
