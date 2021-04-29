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
        // Payment::create($request->except('_token'));
        $ps_id = null; $cbu_id = null;
        if($request->client_id!=null){
            // DEPOSIT ONLY
            $client = Client::where('id',$request->client_id)->first();
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
                'loan_id'=>null,
                'client_id'=>$request->client_id,
                'orno'=>$request->orno,
                'amount'=>0,
                'payment_date'=>date('Y-m-d',strtotime($request->payment_date)),
                'ps_id'=>$ps_id,
                'cbu_id'=>$cbu_id
            ]);
            
            return response()->json(['message'=>'Saved','payment'=>$payment],200);
        }else{
            // PAYMENT IN LOAN
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
    public function update(PaymentRequest $request, $id)
    {
        print_r($request->all());   
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
            $savingIds = array_filter([$payment->ps_id,$payment->cbu_id,$payment->ins_id]);
            
            Transaction::whereIn('id',$savingIds)->update(['confirmed'=>0]);
            Payment::where('id',$id)->delete();
            $client = Client::where('id',$payment->client_id)->first();
            if($client->hasWallet('ps')==true){
                $wallet_ps = $client->getWallet('ps');
                $wallet_ps->refreshBalance();
            }
            if($client->hasWallet('cbu')==true){
                $wallet_cbu = $client->getWallet('cbu');
                $wallet_cbu->refreshBalance();
            }
            return response()->json(['message'=>'Cancelled'],200);
        }else{
            abort(404);
        }
    }

    public function jsonData(Request $request){
        $data = Loan::whereHas('status',function($query){ $query->where('name','RELEASED'); })
                    ->whereHas('payment',function($query) use($request){
                        if($request->has('payment_date')){
                            $query->where('payment_date',$request->payment_date);
                        }   
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
