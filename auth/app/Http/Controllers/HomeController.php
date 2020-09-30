<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Alert;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use DB;
use Carbon\Carbon;
use App\User;
use App\Helpers\Helper;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (Auth::check() && Auth::user()->hasRole('admin')) {
            return redirect()->route('user.dashbord');
        } 
        elseif (Auth::check() &&  Auth::user()->hasRole('simple')) {
            return redirect()->route('produit.list');
        }     
        return view('main.accueil');
        
    }
}
