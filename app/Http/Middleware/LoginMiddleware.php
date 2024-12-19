<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
      
        if ($request->email == "dhaliliakot@gmail.com"){
          return $next($request);    
        }
        else{
            return response()->json([
                'status' => 'error',
                'message' => 'You are not authorized to access this resource.',
            ], 403);
        }     
    }
}
