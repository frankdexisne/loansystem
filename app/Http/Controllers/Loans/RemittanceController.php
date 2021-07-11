<?php

namespace App\Http\Controllers\Loans;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DBLoans\Area;
use App\Models\DBLoans\DailyTransactionReport;
use App\Models\DBLoans\Payment;
class RemittanceController extends Controller
{
    private $dir = 'loan.remittances.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = Area::orderBy('for_daily_areas','DESC')->get();
        return view($this->dir.'index',compact('areas'));
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
        //
    }

    public function jsonPayment(Request $request){
        $data = Payment::where('payment_date',date('Y-m-d',strtotime($request->payment_date)))->whereHas('loan',function($query)  use($request){ $query->whereHas('client',function($query) use($request){ $query->where('area_id',$request->area_id); }); })->with(['ps','cbu','loan'=>function($query){ $query->with('client'); }])->get()->toArray();
        return response()->json(['data'=>$data]);
    }
}
