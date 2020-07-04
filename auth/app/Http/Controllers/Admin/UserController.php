<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function index(){
    	$users = User::all();
    	return view('admin.user.index',compact('users'));
    }

    public function create(){
        $roles = Role::all();
        $permissions = Permission::all();
        $action = route('user.create');
        return view('admin.user.form',compact('roles','permissions','action'));
    }


    public function store(Request $request){
        $this->validate($request,[
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'numero_tel' => ['required', 'string', 'max:255'],
            'service' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
  	    ]);
        $user = User::create($request->all());
        $user->password = Hash::make($request->password);
        $user->syncRoles($request->roles);
        $user->syncPermissions($request->permissions);
        $user->save();
        return redirect(route('user.dashbord'))->with('successMsg','Utilisateur créé avec succès');
    }

    public function edit(User $user){
        $action = route('user.update', ['user' => $user]);
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.user.form',compact('user','roles','permissions','action'));
    }


    public function update(Request $request,User $user){
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->email = $request->email;
        $user->numero_tel = $request->numero_tel;
        $user->service = $request->service;
        $user->syncRoles($request->roles);
        $user->syncPermissions($request->permissions);
        $user->save();
        return redirect(route('user.dashbord'))
        ->with('successMsg','Utilisateur modifié avec succès');
    }


    public function delete(User $user){
        $user->delete();
        return redirect(route('user.dashbord'));
    }

}
