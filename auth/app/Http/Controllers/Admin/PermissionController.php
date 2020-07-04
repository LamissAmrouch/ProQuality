<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class PermissionController extends Controller
{
    public function index(){
    	$permissions = Permission::paginate(10);
    	return view('admin.permission.index',compact('permissions'));
    }

    public function create(){
        $roles = Role::all();
        $action = route('permission.create');
        return view('admin.permission.form',compact('roles','action'));
    }
    
    public function store(Request $request){
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
  	    ]);
        $permission = Permission::create([
            'name'=> $request->name,
            'description'=> $request->description
        ]);
        //$permission->syncRoles($request->roles);
        /*foreach($request->models as $model) {
            $model->givePermissionTo($permission->name);
        }*/
        
        $permission->syncRoles($request->roles);
        $query = $permission->save();
        return redirect(route('permission.dashbord'))
        ->with('successMsg','Permission créé avec succès');

    }

    public function edit(Permission $permission){
        $action = route('permission.update', ['permission' => $permission]);
        $roles = Role::all();
        return view('admin.permission.form',compact('permission','roles','action'));
    }


    public function update(Request $request,Permission $permission){
        $permission->name = $request->name;
        $permission->description = $request->description;
        $permission->syncRoles($request->roles);
        $permission->save();
        return redirect(route('permission.dashbord'))
        ->with('successMsg','Permission modifiée avec succès');
    }


    public function delete(Permission $permission){
        $permission->delete();
        return redirect(route('permission.dashbord'));
    }
}
