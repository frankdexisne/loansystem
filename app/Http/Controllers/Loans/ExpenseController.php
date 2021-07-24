<?php

namespace App\Http\Controllers\Loans;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DBLoans\Expense;
use App\Models\DBLoans\ExpenseType;
use App\Models\DBPayroll\Employee;
use App\Http\Resources\Loans\ExpenseResource;
use App\Http\Requests\Loans\ExpenseRequest;
class ExpenseController extends Controller
{
    private $dir = 'loan.expenses.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::get();
        $expense_types = ExpenseType::get();
        return view($this->dir.'index',['employees'=>$employees,'expense_types'=>$expense_types]);
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
    public function store(ExpenseRequest $request)
    {
        
        $request->merge([
            'employee_id'=>$request->employee_id == 'none' ? null : $request->employee_id
        ]);
        if($request->id!=null){
            Expense::where('id',$request->id)->update($request->except('_token','id'));
        }else{
            Expense::create($request->except('_token'));
        }

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
        Expense::where('id',$id)->delete();
    }

    public function jsonData(Request $request){
        $data = $request->has('payment_mode_id') ? Expense::where('payment_mode_id',$request->payment_mode_id)->whereDate('expense_date',date('Y-m-d',strtotime($request->expense_date)))->with(['employee','expense_type'])->get() : Expense::where('expense_date',$request->expense_date)->with(['employee','expense_type'])->get();
        return ExpenseResource::collection($data);
        
    }
}
