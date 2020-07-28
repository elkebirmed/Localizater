<?php

use Getsupercode\Localizater\Facades\Localizater;

if (! function_exists('locale_route')) {
    /**
     * Get locale route URL/URI.
     *
     * @param string|null $route
     * @param string|null $locale
     * @param array $parameters
     * @param bool $absolute
     * @return string
     */
    function locale_route($route = null, $locale = null, $parameters = [], $absolute = true)
    {
        return Localizater::localeRoute($route, $locale, $parameters, $absolute);
    }
}

if (! function_exists('locale_name')) {
    /**
     * Get locale language name.
     *
     * @param string|null $locale
     * @return string
     */
    function locale_name($locale = null)
    {
        return Localizater::localeName($locale);
    }
}
