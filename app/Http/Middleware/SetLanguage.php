<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLanguage
{
    /**
     * use Illuminate\Support\Facades\Session;
     *
     * @param  Request  $request
     * @param  Closure  $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $localeLanguage = Session::get('languageName');

        if (! isset($localeLanguage)) {
            if (getLogInUser() !=null){
                App::setLocale(getLogInUser()->language);
            }
            else{
                // $localeLanguage = Session::get('languageName');
                App::setLocale(getSuperAdminSettingValue('default_language'));
            }
        } else {
            App::setLocale($localeLanguage);
        }

        return $next($request);
    }
}