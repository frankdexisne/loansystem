<?php

namespace App\Http\Controllers\Loans;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Loans\ChargeRequest;
use App\Models\DBLoans\Charge;
use App\Models\DBLoans\Loan;
use App\Http\Resources\Loans\ChargeResource;
class ChargeController extends Controller
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
    public function store(ChargeRequest $request)
    {
        Charge::create($request->except('_token'));
        return response()->json(['message'=>'Saved'],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $loan = Loan::firstOrNew(['id'=>$id]);
        if($loan->exists){
            $data = $loan->payment_mode_id==1 ? Charge::get() : Charge::where('daily_only',0)->get();
            $content = '';
            foreach($data as $row){
                if($row->id==1){
                    $content .= '<tr><td><input type="checkbox" class="select-charge" value="'.$row->id.'"></td><td>'.$row->name.'('.$loan->interest.'%)</td><td>'.number_format($loan->loan_amount * ($loan->interest/100),2,'.',',').'</td></tr>';
                }
                if($row->is_percent==0 && $row->value>0){
                    $content .= '<tr><td><input type="checkbox" class="select-charge" value="'.$row->id.'"></td><td>'.$row->name.'</td><td>'.number_format($row->value,2,'.',',').'</td></tr>';
                }
            }
            $prev_loan='';
            $loans = Loan::where('client_id',$loan->client_id)->where('status_id',6)->with(['category','term','payment_mode'])->get();
            foreach($loans as $row){
                $prev_loan .='<tr data-byout_of="'.$id.'"><td><input type="checkbox" class="select-loan" value="'.$row->id.'"></td><td>'.$row->transaction_code.'</td><td>'.$row->category->name.'</td><td>'.$row->term->no_of_months.' '.($row->term->daily_only==1 ? 'day(s)' : 'month(s)').'</td><td>'.$row->payment_mode->name.'</td><td>'.number_format($row->balance,2,'.',',').'</td></tr>';
            }
            return response()->json(['data'=>$data->toArray(),'content'=>$content,'prev_loan'=>$prev_loan]);
        }else{
            return response()->json(['data'=>[]]);
        }
        
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
    public function update(ChargeRequest $request, $id)
    {
        Charge::where('id',$id)->update($request->except('_token','id'));
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
        $charge = Charge::firstOrNew(['id'=>$id]);
        if($charge->exists){
            Charge::where('id',$id)->delete();
            return response()->json(['message'=>'Deleted'],200);
        }else{
            abort(404);
        }
    }

    public function jsonData(Request $request){
        $data = Charge::get();
        return ChargeResource::collection($data);
    }
}
