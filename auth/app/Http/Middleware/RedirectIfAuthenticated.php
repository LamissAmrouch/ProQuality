<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check() && Auth::user()->hasRole('admin')) {
            return redirect()->route('user.dashbord');
        } 
        elseif (Auth::guard($guard)->check() && Auth::user()->hasRole('gestionnaire')) {
            return redirect()->route('home');
        } 
        elseif (Auth::guard($guard)->check() && Auth::user()->hasRole('simple')) {
            return redirect()->route('produit.list');
        } 
        else{ 
            return $next($request);
        }
    }
}
