<?php

use Getsupercode\Localizater\Facades\Localizater;

if (! function_exists('locale_route')) {
    /**
     * Get locale route URL/URI.
     *
     * @param string $locale
     * @param string|null $route
     * @param array $parameters
     * @param bool $absolute
     * @return string
     */
    function locale_route($locale, $route = null, $parameters = [], $absolute = true)
    {
        return Localizater::localeRoute($locale, $route, $parameters, $absolute);
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
