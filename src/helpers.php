<?php

if (! function_exists('nt_route'))
{
    /**
     * Generate the URL for named route.
     *
     * @param  string  $name
     * @param  array   $parameters
     * @param  bool    $absolute
     * @return string
     */
    function nt_route($name, $parameters = [], $absolute = true)
    {
        $routes = \Illuminate\Support\Facades\Route::getRoutes();
        $route  = $routes->getByName($name);

        // set cms version value
        if (request()->has('cmsVersion')) $parameters['cmsVersion'] = request()->input('cmsVersion');

        return route($name, $parameters, $absolute);
    }
}