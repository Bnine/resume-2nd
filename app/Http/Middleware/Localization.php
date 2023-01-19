<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Lang;

class Localization
{
    private $acceptedLanguage;
    private $allowedLanguages = ['ko', 'en', 'jp'];
    private $defaultAcceptedLanguage = 'ko';

    public function __construct(Request $request)
    {
        $this->acceptedLanguage = strtolower($request->header('Accept-Language', 'ko'));
        if (in_array($this->acceptedLanguage, $this->allowedLanguages)) {
            Lang::setLocale($this->acceptedLanguage);
        } else {
            Lang::setLocale($this->defaultAcceptedLanguage);
        }
        Log::debug(__METHOD__.'lang - getLocale : '.Lang::getLocale());
    }

    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }

    /**
     * use Illuminate\Contracts\Foundation\Application;
     * app - locale controll
     */
    /*
    public function __construct(Application $app, Request $request)
    {
        $this->acceptedLanguage = strtolower($request->header('Accept-Language', 'ko'));
        if (in_array($this->acceptedLanguage, $this->allowedLanguages)) {
            $app->setLocale($this->acceptedLanguage);
        } else {
            $app->setLocale($this->defaultAcceptedLanguage);
        }
        Log::debug(__METHOD__.'getLocale : '.$app->getLocale());
    }
    */
}
