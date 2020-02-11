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

if (! function_exists('active_route'))
{
    /**
     * Get user country from session.
     * @param   string      $routeNames         names of routes to check
     * @param   string      $class              class to return if route is active
     * @param   bool        $firstOccurrence    active to find first occurrence of route, this method is valid to active menu on subsections
     * @return  boolean
     */
    function active_route($routeNames, $class = 'active', $firstOccurrence = false)
    {
        // if doesn't has any route with the current url, Request::route() will be null
        if (Request::route() === null) return null;

        if (!is_array($routeNames)) $routeNames = [$routeNames];

        $found = false; // found occurrence

        if ($firstOccurrence)
        {
            foreach ($routeNames as $routeName)
            {
                if (strpos(Request::url(), route($routeName)) !== 0)
                {
                    $found = true;
                    break;
                }
            }
        }
        else
        {
            // check that route exist
            if (Request::route() === null)
                return false;

            foreach ($routeNames as $routeName)
            {
                if (Request::route()->getName() === $routeName)
                {
                    $found = true;
                    break;
                }
            }
        }

        if ($found) return $class;
    }
}