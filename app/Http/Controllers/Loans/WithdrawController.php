<?php

namespace App\Http\Controllers\Loans;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DBLoans\Withdraw;
use App\Models\DBLoans\Wallet;
use App\Models\DBLoans\Transaction;
use App\Models\DBLoans\Client;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Str;
class WithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        if($request->has('client_id')){
            $client = Client::firstOrNew(['id'=>$request->client_id]);
            if($client->exists){
                $wallet = $client->getWallet($request->wallet_name);
                
                $validation = Validator::make($request->all(),[
                    'amount'=>'required|numeric|lte:'.$wallet->balance
                ]);

                if($validation->fails()){
                    return response()->json(['message'=>'Invalid inputs','errors'=>$validation->errors()],422);
                }else{
                    
                    if($client->hasWallet($request->wallet_name)==true){
                        if($request->amount<=$client->getWallet($request->wallet_name)->balance){
                            $wallet = $client->getWallet($request->wallet_name);
                            $transaction= $wallet->withdraw($request->amount);
                            $wallet->refreshBalance();
                            $reference_no = 'W-'.date('y',strtotime(Carbon::now())).Str::random(5);
                            $withdraw=Withdraw::create(['client_id'=>$request->client_id,'transaction_id'=>$transaction->id,'reference_no'=>$reference_no,'withdraw_date'=>date('Y-m-d',strtotime($request->payment_date)),'amount'=>$request->amount]);
                            return response()->json(['message'=>'Saved','withdraw'=>$withdraw],200);
                        }
                    }
                }
                
            }
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
        $withdraw = Withdraw::where('id',$id)->with(['transaction','client'])->first();        
        $wallets = Wallet::where('holder_type','App\Models\DBLoans\Client')->where('holder_id',$withdraw->client_id)->get();
        $wallet_id = Wallet::where('holder_type','App\Models\DBLoans\Client')->where('holder_id',$withdraw->client_id)->where('slug',$request->wallet_name)->first()->id;
        
        Withdraw::where('id',$id)->update([
            'amount'=>$request->amount,
            'withdraw_date'=>date('Y-m-d',strtotime($request->withdraw_date))
        ]);

        Transaction::where('id',$withdraw->transaction_id)->update([
            'wallet_id'=>$wallet_id,
            'amount'=>'-'.$request->amount
        ]);
        
        foreach($wallets as $wallet){
            $withdraw->client->getWallet($wallet->slug)->refreshBalance();
        }
        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $withdraw = Withdraw::firstOrNew(['id'=>$id]);
        if($withdraw->exists){
            
            Transaction::where('id',$withdraw->transaction_id)->update(['confirmed'=>0]);
            Withdraw::where('id',$id)->delete();
            $client = Client::where('id',$withdraw->client_id)->first();
            $wallets = Wallet::where('holder_type','App\Models\DBLoans\Client')->where('holder_id',$withdraw->client_id)->get();
            foreach($wallets as $wallet){
                $client->getWallet($wallet->slug)->refreshBalance();
            }
            return response()->json(['message'=>'Cancelled'],200);
        }else{
            abort(404);
        }
    }

    public function jsonData(Request $request){

    }
}
