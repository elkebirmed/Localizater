<?php

namespace Getsupercode\Localizater;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;

class Localizater
{
    /**
     * Available locales.
     *
     * @var array
     */
    protected $locales;

    /**
     * RTL locales.
     *
     * @var array
     */
    protected $rtl_locales;

    /**
     * Default locale.
     *
     * @var string
     */
    protected $locale;

    /**
     * Prefix default locale or not.
     *
     * @var bool
     */
    protected $prefixDefault;

    /**
     * Prefix default locale route name or not.
     *
     * @var bool
     */
    protected $prefixDefaultName;

    /**
     * Router instance.
     *
     * @var \Illuminate\Routing\Router
     */
    protected $router;

    /**
     * Initiating.
     */
    public function __construct()
    {
        $this->locales = Config::get('localizater.locales');
        $this->rtl_locales = Config::get('localizater.rtl_locales');
        $this->locale = Config::get('app.locale');
        $this->prefixDefault = Config::get('localizater.prefix_default');
        $this->prefixDefaultName = Config::get('localizater.prefix_default_name');
        $this->router = App::make('router');
    }

    /**
     * Create a route group with shared attributes and multiple locales.
     *
     * @param \Closure|string|array $attributes
     * @param \Closure $handle
     * @return \Illuminate\Routing\Router|\Illuminate\Routing\RouteRegistrar
     */
    protected function group($attributes, $handle)
    {
        foreach ($this->locales as $key => $value) {
            $this->router->group([
                'prefix' => $this->prefix($key),
                'as' => $this->as($key),
            ], function () use ($attributes, $handle) {
                $this->router->group($attributes, $handle);
            });
        }
    }

    /**
     * Get locale route URL/URI.
     *
     * @param string|null $route
     * @param string|null $locale
     * @param array $parameters
     * @param bool $absolute
     * @return string
     */
    protected function localeRoute($route = null, $locale = null, $parameters = [], $absolute = true)
    {
        // Get route
        $route = $this->route($route, $parameters, $absolute);

        // Get route URL path
        $parse_url = parse_url($route, PHP_URL_PATH);

        // Get route URL query strings
        $parse_query = parse_url($route, PHP_URL_QUERY);

        // Get root domain
        $root = preg_replace('/\/$/', '', Request::root());

        // Get route URL query strings
        $segments = explode('/', $parse_url);

        // Get wanted locale.
        $locale = $locale ?: App::getLocale();

        // If this is welcome page add the default locale as a segment
        if (! $parse_url) {
            $segments[1] = $this->locale;
        }

        // Check if locale exists
        if (array_key_exists($segments[1], $this->locales)) {
            unset($segments[1]);
        }

        // Change the locale prefix
        if ($this->locale == $locale && ! $this->prefixDefaultName) {
            array_splice($segments, 1, 0);
        } else {
            array_splice($segments, 1, 0, $locale);
        }

        // Make route
        $url = '/'.implode('/', array_values(array_filter($segments)));

        // Add path to domain
        if ($absolute) {
            $url = $root.$url;
        }

        // Add query strings if exists
        if ($parse_query) {
            $url = $url.'?'.$parse_query;
        }

        return $url;
    }

    /**
     * Get locale language name.
     *
     * @param string|null $locale
     * @return string
     */
    protected function localeName($locale = null)
    {
        return Config::get('localizater.locales')[$locale ?: App::getLocale()];
    }

    /**
     * Get `prefix` attribute.
     *
     * @param string $key
     * @return string
     */
    protected function prefix(string $key): string
    {
        return ! $this->prefixDefault && $key === $this->locale ? '' : $key;
    }

    /**
     * Get `as` attribute.
     *
     * @param string $key
     * @return string
     */
    protected function as(string $key): string
    {
        return ! $this->prefixDefaultName && $key === $this->locale ? '' : $key.'.';
    }

    /**
     * Get route full URL.
     *
     * @param string|null $route
     * @param array $parameters
     * @param bool $absolute
     * @return string
     */
    protected function route($route = null, $parameters = [], $absolute = true)
    {
        return $route
            ? route($route, $parameters, $absolute)
            : URL::full();
    }

    /**
     * Get locale direction.
     *
     * @return string
     */
    public function localeDir()
    {
        return in_array(App::getLocale(), $this->rtl_locales) ? 'rtl' : 'ltr';
    }

    /**
     * Call methods dynamically.
     *
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public function __call(string $name, array $arguments)
    {
        if ($name === 'group') {
            if ($arguments[0] instanceof \Closure) {
                $this->group([], ...$arguments);
            } else {
                $this->group(...$arguments);
            }
        }

        if ($name === 'localeRoute') {
            return $this->localeRoute(...$arguments);
        }

        if ($name === 'localeName') {
            return $this->localeName(...$arguments);
        }

        if ($name === 'getLocale') {
            return $this->locale;
        }
    }
}
