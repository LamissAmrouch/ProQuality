<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class RoleController extends Controller
{
    public function index(){
    	$roles = Role::paginate(5);
    	return view('admin.role.index',compact('roles'));
    }

    public function create(){
        $permissions = Permission::all();
        $action = route('role.create');
        return view('admin.role.form',compact('permissions','action'));
    }


    public function store(Request $request){
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
  	    ]);
        $role = Role::create(['name'=>$request->name, 'description'=>$request->description]);
        $role->syncPermissions($request->permissions);
        $role->save();

        return redirect(route('role.dashbord'))        
        ->with('successMsg','Role créé avec succès');
    
    }

    public function edit(Role $role){
        $action = route('role.update', ['role' => $role]);
        $permissions = Permission::all();
        return view('admin.role.form',compact('role','permissions','action'));
    }


    public function update(Request $request,Role $role){
        $role->name = $request->name;
        $role->description = $request->description;
        $role->syncPermissions($request->permissions);
        $role->save();
        return redirect(route('role.dashbord'))        
        ->with('successMsg','Role modifié avec succès');

    }


    public function delete(Role $role){
        $role->delete();
        return redirect(route('role.dashbord'));
        }
}
