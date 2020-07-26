<?php

namespace Getsupercode\Localizater;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Getsupercode\Localizater\Facades\Localizater;

class LocalizaterMiddleware
{
    /**
     * Available locales.
     *
     * @var array
     */
    protected $locales;

    /**
     * Default locale.
     *
     * @var string
     */
    protected $defaultLocale;

    /**
     * Initiating.
     */
    public function __construct()
    {
        $this->locales = Config::get('localizater.locales');
        $this->defaultLocale = Localizater::getLocale();
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Get first URL segment
        $segment = $request->segment(1);

        // Check if segment is a locale prefix
        $isLocale = key_exists($segment, $this->locales);

        // Change locale
        if ($isLocale) {
            App::setLocale($segment);
        } else {
            App::setLocale($this->defaultLocale);
        }

        return $next($request);
    }
}
