<?php

namespace App\Http\Controllers\Loans;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Loans\PaymentRequest;
use App\Models\DBLoans\Payment;
use App\Models\DBLoans\Client;
use App\Models\DBLoans\Loan;
use App\Models\DBLoans\Transaction;
use App\Http\Resources\Loans\LoanResource;
use DB;
class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('payments.index');
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

    
    public function store(PaymentRequest $request)
    {
        
        $ps_id = null; $cbu_id = null;$settled_loan=0;
        $client_id = $request->has('loan_client_id') ? $request->loan_client_id :$request->client_id;
        $request_client_id = $request->has('loan_client_id') ? null :$request->client_id;
        
        $client = Client::where('id',$client_id)->first();
        
        if($client->hasWallet('ps')==false){
            $client->createWallet([
                'name' => 'PERSONAL SAVINGS',
                'slug' => 'ps'
            ]);
        }
        if($client->hasWallet('cbu')==false){
            $client->createWallet([
                'name' => 'CAPITAL BUILD UP',
                'slug' => 'cbu'
            ]);
        }
        $ps = $request->ps!=null ? $request->ps : 0;
        $cbu = $request->cbu!=null ? $request->cbu : 0;

        if($ps>0){
            $wallet_ps = $client->getWallet('ps');
            $deposit_ps=$wallet_ps->deposit($ps);
            $ps_id=$deposit_ps->id;
            $wallet_ps->refreshBalance();
        }
        if($cbu>0){
            $wallet_cbu = $client->getWallet('cbu');
            $deposit_cbu=$wallet_cbu->deposit($cbu);
            $cbu_id=$deposit_cbu->id;
            $wallet_cbu->refreshBalance();
        }

        $payment = Payment::create([
            'loan_id'=>$request->has('loan_id') ? $request->loan_id : null,
            'client_id'=>$request->has('loan_client_id') ? null : $request->client_id,
            'orno'=>$request->orno,
            'amount'=>$request->has('amount') ? $request->amount : 0,
            'payment_date'=>date('Y-m-d',strtotime($request->payment_date)),
            'ps_id'=>$ps_id,
            'cbu_id'=>$cbu_id
        ]);

        if($request->loan_id!=null){
            $settled = Payment::where('loan_id',$request->loan_id)->sum('amount');
            $loan = Loan::where('id',$request->loan_id);
            $loan_data = $loan->first();
            $loan_amount_with_interest = ($loan_data->loan_amount + ($loan_data->loan_amount*($loan_data->interest/100)));
            $balance = $loan_amount_with_interest - $settled;
            $over = $settled>$loan_amount_with_interest ? $settled-$loan_amount_with_interest : 0;
            $status_id = $settled>=$loan_amount_with_interest ? 7 : $loan_data->status_id;
            $settled_loan = $settled>=$loan_amount_with_interest ? 1 : 0;
            $loan->update(['balance'=>$balance,'settled'=>$settled,'status_id'=>$status_id,'over'=>$over]);
        }
        
        return response()->json(['message'=>'Saved','payment'=>$payment,'settled_loan'=>$settled_loan],200);
        
        
        
        
        
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
    

    public function update(PaymentRequest $request, $id)
    {
        $ps_id = null; $cbu_id = null;
        $payment = Payment::where('id',$id);
        $data = $payment->first();

        
        Transaction::whereIn('id',[$data->ps_id,$data->cbu_id])->update(['confirmed'=>0]);
        
        
        $client_id = $request->has('loan_client_id') ? $request->loan_client_id : $request->client_id;
        $client = Client::where('id',$client_id)->first();
        if($client->hasWallet('ps')==false){
            $client->createWallet([
                'name' => 'PERSONAL SAVINGS',
                'slug' => 'ps'
            ]);
        }
        if($client->hasWallet('cbu')==false){
            $client->createWallet([
                'name' => 'CAPITAL BUILD UP',
                'slug' => 'cbu'
            ]);
        }
        $ps = $request->ps!=null ? $request->ps : 0;
        $cbu = $request->cbu!=null ? $request->cbu : 0;

        

        if($ps>0){
            $wallet_ps = $client->getWallet('ps');
            $deposit_ps=$wallet_ps->deposit($ps);
            $ps_id=$deposit_ps->id;
            $wallet_ps->refreshBalance();
        }
        if($cbu>0){
            $wallet_cbu = $client->getWallet('cbu');
            $deposit_cbu=$wallet_cbu->deposit($cbu);
            $cbu_id=$deposit_cbu->id;
            $wallet_cbu->refreshBalance();
        }

        $payment->update([
            'orno'=>$request->orno,
            'payment_date'=>$request->payment_date,
            'amount'=>$request->amount,
            'ps_id'=>$ps_id,
            'cbu_id'=>$cbu_id
        ]);

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $payment = Payment::firstOrNew(['id'=>$id]);
        if($payment->exists){
            DB::transaction(function() use($id,$payment){
                $payment = Payment::where('id',$id)->with('loan')->first();
                $savingIds = array_filter([$payment->ps_id,$payment->cbu_id,$payment->ins_id]);
                Transaction::whereIn('id',$savingIds)->update(['confirmed'=>0]);
                
                if($payment->ps_id!=null || $payment->cbu_id!=null){
                    $client_id=$payment->client_id!=null ? $payment->client_id : $payment->loan->client_id;
                    $client = Client::where('id',$client_id)->first();
                    if($client->hasWallet('ps')==true){
                        $wallet_ps = $client->getWallet('ps');
                        $wallet_ps->refreshBalance();
                    }
                    if($client->hasWallet('cbu')==true){
                        $wallet_cbu = $client->getWallet('cbu');
                        $wallet_cbu->refreshBalance();
                    }
                }
                Payment::where('id',$id)->delete();
                return response()->json(['message'=>'Cancelled'],200);
            });
        }else{
            abort(404);
        }
    }

    public function jsonData(Request $request){
        
        $data = Loan::whereHas('status',function($query){ $query->whereIn('name',['RELEASED','CLOSED']); })
                    ->whereHas('payment',function($query) use($request){
                        if($request->has('payment_date')){
                            $query->where('payment_date',$request->payment_date);
                        }   
                    })
                    ->where('payment_mode_id',$request->payment_mode_id)
                    ->whereHas('client',function($query) use($request){
                        $query->where('area_id',$request->area_id);
                    })
                    ->with(['payment'=>function($query) use($request){
                        if($request->has('payment_date')){
                            $query->where('payment_date',$request->payment_date);
                        }   
                    },'client'])
                    
                    ->get();
        return LoanResource::collection($data);

        // $data = Payment::whereHas('loan',function($query) use($request){
        //                     $query->whereHas()
        //                 })
    }
}
