<?php

namespace App\Http\Middleware;

use view;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (session('g2fakey')) {

            // dd('Block');

            return redirect()->route('admin.g2faverify');
        }

        if (Auth::guard('admin')->check()) {
            return $next($request);
        }
        //return $next($request);

        return redirect()->route('admin.login');
    }
}
