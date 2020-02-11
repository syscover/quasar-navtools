<?php namespace Quasar\Navtools\Middleware;

use Closure;

class Versions
{
    /**
     * @param   $request
     * @param   Closure $next
     * @return  mixed
     */
    public function handle($request, Closure $next)
    {
        
        
        return $next($request);
    }
}