<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class Admin_login
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user =  auth('sanctum')->user();
        
        if (!empty($user->role) AND $user->role== '1' ) {
            
            return $next($request);
        }else{
            dd("else");
            return redirect('login');
        }
    }
}
