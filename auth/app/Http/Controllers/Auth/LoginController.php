<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo;
    //= RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /*if (Auth::check() && Auth::user()->hasRole('admin')){
            $this->redirectTo = route('user.dashbord');
        } 
        elseif (Auth::check() && Auth::user()->hasRole('gestionnaire')){
            $this->redirectTo = route('home');
        }
        elseif (Auth::check() && Auth::user()->hasRole('gestionnaire')){
            $this->redirectTo = route('produit.list');
        }
        else{ 
            $this->redirectTo = route('home');
        }       */ 
        $this->redirectTo = route('home');
        $this->middleware('guest')->except('logout');   
    }
}
