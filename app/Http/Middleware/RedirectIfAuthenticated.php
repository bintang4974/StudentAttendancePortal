<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard('student')->check()) {
                return redirect(RouteServiceProvider::HOME);
            }

            if (Auth::guard('user')->check()) {
                return redirect(RouteServiceProvider::HOMEADMIN);
            }
        }

        // foreach ($guards as $guard) {
        //     if (Auth::guard($guard)->check()) {
        //         return match($guard) {
        //             'student' => redirect(RouteServiceProvider::HOME),
        //             default => redirect(RouteServiceProvider::HOMEADMIN),
        //         };
        //     }
        // }

        // foreach ($guards as $guard) {
        //     if (Auth::guard($guard)->check()) {
        //         switch ($guard) {
        //             case 'student':
        //                 return redirect(RouteServiceProvider::HOME); // /dashboard
        //             case 'user':
        //                 return redirect(RouteServiceProvider::HOMEADMIN); // /panel/dashboardadmin
        //         }
        //     }
        // }


        return $next($request);
    }
}
