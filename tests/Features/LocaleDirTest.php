<?php

namespace Getsupercode\Localizater\Tests\Features;

use Getsupercode\Localizater\Tests\TestCase;

class LocaleDirTest extends TestCase
{
    /** @test */
    public function canGetCurrentLocaleDir()
    {
        app()->setlocale('ar');

        $this->assertEquals(locale_dir(), 'rtl');
    }

    /** @test */
    public function canGetSpecifiedLocaleDir()
    {
        $this->assertEquals(locale_dir('en'), 'ltr');
        $this->assertEquals(locale_dir('fr'), 'ltr');
        $this->assertEquals(locale_dir('ar'), 'rtl');
    }
}
