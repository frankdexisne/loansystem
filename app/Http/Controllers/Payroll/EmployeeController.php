<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Payroll\EmployeeRequest;
use App\Models\DBPayroll\Employee;
use App\Models\DBLoans\Area;
use App\Models\User;
use App\Http\Resources\Payroll\EmployeeResource;
use Illuminate\Support\Str;
use Validator;
use Hash;
class EmployeeController extends Controller
{
    private $dir = 'payroll.employees.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view($this->dir.'index');
        
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
    public function store(EmployeeRequest $request)
    {
        // if($request->has('id')){
        //     Employee::where('id',$request->id)->update($request->except('_token','id'));
        // }else{
        //     Employee::create($request->except('_token','id'));
        // }
        // return response()->json(['message'=>'Saved']);
        $request->merge(['employee_no'=>'EMP-'.Str::random(10)]);
        $employee = Employee::create($request->except('_token'));
        $data = Employee::where('id',$employee->id)->with(['branch','job_title','user'])->first();
        return response()->json(['message'=>'Saved','data'=>$data],200);
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
    public function update(EmployeeRequest $request, $id)
    {
        Employee::where('id',$id)->update($request->except('_token','id'));
        return response()->json(['message'=>'Saved'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::firstOrNew(['id'=>$id]);
        if($employee->exists){
            Employee::where('id',$id)->delete();
            return response()->json(['message'=>'Deleted'],200);
        }else{
            abort(404);
        }
    }

    public function jsonData(Request $request){
        $data = Employee::whereHas('job_title',function($query) use($request){ if($request->has('job_title')){ $query->where('name',$request->job_title); } })->with(['job_title','branch','user'=>function($query){ $query->with(['model_has_role'=>function($query){ $query->with('role'); }]); },'area'])->get();
        return EmployeeResource::collection($data);        
    }

    public function addUser(Request $request){
        $validation = Validator::make($request->all(),[
            'username'=>'required|unique:dbsystem.users,email'
        ]);
        if($validation->fails()){
            return response()->json(['message'=>'Invalid Input','errors'=>$validation->errors()]);
        }else{
            $user = User::create([
                'name'=>$request->name,
                'email'=>$request->username,
                'password'=>$request->password!=null ? Hash::make($request->password) : Hash::make('PassworD')
            ]);
            Employee::where('id',$request->id)->update(['user_id'=>$user->id]);
            return response()->json(['message'=>'Saved'],200);
        }
    }

    public function assign(Request $request){
        $area = Area::create($request->only('branch_id','name'));
        Employee::where('id',$request->id)->update(['area_id'=>$area->id]);
        return response()->json(['message'=>'Success']);
    }
}
