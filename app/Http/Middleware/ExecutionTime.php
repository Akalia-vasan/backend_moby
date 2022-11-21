<?php

namespace App\Http\Middleware;

use Closure;

class ExecutionTime
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Get the response
        $response = $next($request);

        // Calculate execution time
        $executionTime = intval(microtime(true) - floor(LUMEN_START));

        // I assume you're using valid json in your responses
        // Then I manipulate them below
        
        return $response;
    }
}