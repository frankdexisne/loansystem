<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\ModelHasRole;
use App\Models\DBPayroll\Employee;
use App\Http\Resources\System\UserResource;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::firstOrNew(['id'=>$id]);
        if($user->exists){
            Employee::where('user_id',$id)->update(['user_id'=>null]);
            User::where('id',$id)->delete();
            return response()->json(['message'=>'Deleted'],200);
        }else{
            abort(404);
        }
    }

    public function jsonData(Request $request){
        $data = User::get();
        return UserResource::collection($data);
    }

    public function assignRole(Request $request){
        
        $modelHasRole = ModelHasRole::firstOrNew(['model_id'=>$request->user_id])
                                    ->fill([
                                        'model_type'=>'App\Models\User',
                                        'role_id'=>$request->role_id
                                    ]);
        if($modelHasRole->exists){
            $modelHasRole->update();
        }else{
            $modelHasRole->save();
        }
        return response()->json(['message'=>'Success']);
        
    }
}
