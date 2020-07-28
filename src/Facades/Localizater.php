<?php

namespace Getsupercode\Localizater\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Illuminate\Routing\Router|\Illuminate\Routing\RouteRegistrar group(\Closure|string|array $attributes, \Closure $handle)
 * @method static string localeRoute(string|null $route = null, string|null $locale, array $parameters = [], bool $absolute = true)
 * @method static string localeName(string|null $locale)
 * @method static string getLocale()
 *
 * @see Getsupercode\Localizater\Localizater
 */
class Localizater extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'localizater';
    }
}
