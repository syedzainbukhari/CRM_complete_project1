<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;


use App\Models\Role;

class RoleController extends Controller
{
    //
    public function index(){
        return view('admin.roles.index',[
            'roles'=> Role::all()
        ]);
    }
    public function store(){
        request()->validate([
            'name' => ['required']
        ]);
       Role::create([
        'name' => request('name'),
        'slug' => Str::lower(request('name'))

       ]);
       return back();
    }
    
    public function destroy(Role $role){
        $role -> delete();
        return back();
    }
    

}
