<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Module;
use Spatie\Permission\Models\Role as VendorRole;
use App\Http\Resources\System\RoleResource;
use Validator;
class RoleController extends Controller
{
    public function jsonData(Request $request){
        $data = Role::with(['role_has_permission'=>function($query){ $query->with('permission'); }])->get();
        return RoleResource::collection($data);
    }

    public function jsonDataVendor(Request $request){
        $data = VendorRole::with('permissions')->get();
        return RoleResource::collection($data);
        
    }

    public function moduleJsonData(Request $request){
        $data = Module::with('permission')->get();
        return RoleResource::collection($data);
    }

    public function store(Request $request){
        
        $validation = Validator::make($request->all(),[
            'roles'=>'required',
            'permissions'=>'required'
        ]);
        if($validation->fails()){
            return response()->json(['message'=>'Invalid inputs','errors'=>$validation->errors()],422);
        }else{
            $roles = $request->roles;

            foreach($roles as $role_id){
                $role = VendorRole::where('id',$role_id)->first();
                $role->syncPermissions($request->permissions);
            }

            return response()->json(['message'=>'Success'],200);
        }
        
    }
}
