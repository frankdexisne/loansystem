<?php

namespace App\Http\Controllers\Loans;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DBLoans\Loan;
use App\Models\DBLoans\Client;
use App\Models\DBLoans\Status;
use App\Models\DBLoans\Schedule;
use App\Models\DBLoans\Charge;
use App\Models\DBLoans\LoanCharge;
use App\Models\DBLoans\Area;
use App\Models\DBLoans\Payment;
use App\Http\Resources\Loans\LoanResource;
use App\Http\Requests\Loans\UpdateLoanRequest;
use PDF;
use DB;
class LoanController extends Controller
{   
    private $dir = 'loan.loans.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('loans.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->dir.'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $client = Client::firstOrNew(['id'=>$request->client_id]);
        if($client->exists){
            $status = Status::where('name','FOR APPROVAL')->first();

            $loan = [
                'client_id'=>$request->client_id,
                'area_id'=>html_entity_decode($client->area_id),
                'transaction_code'=>$client->account_no.'-'.date('Ymd'),
                'category_id'=>html_entity_decode($request->category_id),
                'term_id'=>html_entity_decode($request->term_id),
                'payment_mode_id'=>html_entity_decode($request->payment_mode_id),
                'loan_amount'=>html_entity_decode($request->loan_amount),
                'interest'=>html_entity_decode($request->interest),
                'date_loan'=>date('Y-m-d'),
                'group_id'=>$client->group_id,
                'status_id'=>$status->id,
                'settled'=>0,
                'balance'=>0,
                'over'=>0,
                'payment_per_sched'=>0,
            ];

            $createLoan = Loan::create($loan);
            return response()->json(['message'=>'Loan has been created'],200);
        }else{
            return response()->json(['message'=>'Client doesnt exist'],422);
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
    public function update(UpdateLoanRequest $request, $id)
    {
        $loan = Loan::firstOrNew(['id'=>$id]);
        if($loan->exists){
            if(in_array($loan->status_id,[1,2,3,5])){
                Loan::find($id)->update([
                    'category_id'=>$request->category_id,
                    'payment_mode_id'=>$request->payment_mode_id,
                    'term_id'=>$request->term_id,
                    'loan_amount'=>$request->loan_amount,
                    'interest'=>$request->interest
                ]);
                return response()->json(['message'=>'Success'],200);    
            }else{
                return response()->json(['message'=>'Unable to update'],422);    
            }
        }else{
            return response()->json(['message'=>'Loan doesnt exists'],422);
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
        $loan = Loan::where('id',$id);
        if($loan->first()){
            $loan_with_payment = $loan->with('payment')->first();
            if($loan_with_payment->payment->count()==0){
                LoanCharge::where('loan_id',$id)->delete();
                Schedule::where('loan_id',$id)->delete();
                $loan->delete();
                return response()->json(['message'=>'Deleted'],200);    
            }else{
                return response()->json(['message'=>'This loan has already payments'],422);    
            }
        }else{
            return response()->json(['message'=>'Loan doesnt exist'],422);
        }
        
    }

    public function approval(Request $request){
        $name = $request->action == 'APPROVED' ? 'APPROVED' : 'DENIED';
        $status = Status::firstOrNew(['name'=>$name]);
        if($status->exists){
            Loan::whereIn('id',$request->loan_ids)
                 ->whereHas('status',function($query){
                     $query->where('name','FOR APPROVAL');
                 })
                 ->update(['status_id'=>$status->id]);
                 return response()->json(['message'=>'success'],200);
        }
    }

    public function approval_old(Request $request){
        $name = $request->action == 'approve' ? 'APPROVED' : 'DENIED';
        $status = Status::firstOrNew(['name'=>$name]);
        if($status->exists){
            $loan=Loan::firstOrNew(['id'=>$request->id]);
            if($loan->exists){
                if($loan->status_id==2){
                    Loan::where('id',$request->id)->update(['status_id'=>$status->id]);
                    return response()->json(['message'=>'success'],200);
                }else{
                    return response()->json(['message'=>'Invalid loan status'],422);
                }
            }else{
                return response()->json(['message'=>'Loan doesnt exists'],422);
            }
            
        }
    }

    public function for_release(Request $request){
        $request->merge([
            'status_id'=>5
        ]);
        Loan::where('id',$request->loan_id)->update($request->only('to_release_at','first_payment','status_id'));
        foreach($request->charges as $charge){
            LoanCharge::create($charge);
        }
        if($request->has('byouts')){
            Loan::whereIn('id',$request->byouts)->update(['byout_of'=>$request->loan_id]);
        }
        return response()->json(['message'=>'Successfully add to for release'],200);
    }

    public function for_release1(Request $request){
        $name = 'FOR RELEASE';
        $status = Status::firstOrNew(['name'=>$name]);
        if($status->exists){
            $loan=Loan::firstOrNew(['id'=>$request->id]);
            if($loan->exists){
                
                if($loan->status_id==3){
                        
                    // $request_chrg_ids=$request->charges;
                    // $total_prev_balance = 0;
                    if($request->has('byouts')){
                        Loan::whereIn('id',$request->byouts)->update(['byout_of'=>$request->id]);
                        // $total_prev_balance = Loan::whereIn('id',$request->byouts)->sum('balance');
                        // if($total_prev_balance>0){
                        //     LoanCharge::create(['loan_id'=>$request->id,'charge_id'=>9,'amount'=>$total_prev_balance]);
                        // }
                    }
                    // if($request_chrg_ids!=null){
                    //     foreach($request_chrg_ids as $chrg_id){
                            
                    //         $chrg=Charge::where('id',$chrg_id)->first();
                    //         if($chrg->id==1){
                    //             $amount = $loan->loan_amount * ($loan->interest/100);
                    //             LoanCharge::create(['loan_id'=>$request->id,'charge_id'=>$chrg_id,'amount'=>$amount]);
                    //         }else{
                    //             $amount = $chrg->is_percent==1 ? $loan->loan_amount * ($chrg->value/100) : $chrg->value;
                    //             LoanCharge::create(['loan_id'=>$request->id,'charge_id'=>$chrg_id,'amount'=>$amount]);
                    //         }
                            
                    //     }
                    // }
                    
                    Loan::where('id',$request->id)->update([
                        'status_id'=>$status->id
                    ]);
                    
                    
                    return response()->json(['message'=>'success'],200);
                }else{
                    return response()->json(['message'=>'Invalid loan status'],422);
                }
            }else{
                return response()->json(['message'=>'Loan doesnt exists'],422);
            }
            
        }
    }

    
    

    public function release(Request $request){
        
        $name = 'RELEASED';
        $status = Status::firstOrNew(['name'=>$name]);
        if($status->exists){
            $loan=Loan::firstOrNew(['id'=>$request->id]);
            if($loan->exists){
                if($loan->status_id==5){
                    $maturity_date = null;
                    $amount_due=0;
                    $loan_amount = $loan->loan_amount;
                    $interest = $loan->interest/100;
                    if($loan->payment_mode_id==1){
                        $maturity_date = date('Y-m-d',strtotime($request->first_payment.'+99 days'));
                        $amount_due = ($loan_amount+($loan_amount*$interest))/100;
                    }else{
                        $add_days = $loan->payment_mode->add_days;
                        $term = $loan->term->no_of_months;
                        $divisor = in_array($add_days,[15,30]) ? ($term*30)/$add_days : ($term*4);
                        $amount_due = ($loan_amount+($loan_amount*$interest))/$divisor;
                        
                        $date=date('Y-m-d',strtotime($request->first_payment));
                        
                        $schedules = [];
                        
                        for($i=0;$i<$divisor;$i++){    
                            array_push($schedules,[
                                'loan_id'=>$request->id,
                                'schedule_date'=>$date,
                                'progress'=>0,
                            ]);
                            $date=date('Y-m-d',strtotime($date.'+ '.$add_days.' days'));  
                        }
                        $maturity_date = $schedules[count($schedules)-1]['schedule_date'];
                        Schedule::insert($schedules);
                    }
                    
                    if($request->has('charges')){
                        LoanCharge::where('loan_id',$request->id)->delete();
                        foreach($request->charges as $charge){
                            LoanCharge::create([
                                'loan_id'=>$request->id,
                                'charge_id'=>$charge['charge_id'],
                                'amount'=>$charge['amount']
                            ]);
                        }
                    }
                    $total_deduction = LoanCharge::where('loan_id',$request->id)->sum('amount');

                    $request->merge([
                        'first_payment'=>$request->first_payment,
                        'maturity_date'=>$maturity_date
                    ]);

                    
                    $branch = getWorkStation()->branch;

                    $wallet = $loan->payment_mode_id==1 ? $branch->getWallet('daily_coh') : $branch->getWallet('weekly_coh');
                    $transaction= $wallet->withdraw($loan->loan_amount-$total_deduction);
                    $wallet->refreshBalance();

                    Loan::find($request->id)->update([
                        'status_id'=>$status->id,
                        'date_release'=>date('Y-m-d',strtotime($request->release_date)),
                        'first_payment'=>date('Y-m-d',strtotime($request->first_payment)),
                        'maturity_date'=>$request->maturity_date,
                        'payment_per_sched'=>$amount_due,
                        'transaction_id'=>$transaction->id,
                        'balance'=>$loan->loan_amount + ($loan->loan_amount * ($loan->interest/100))
                    ]);

                    
                    
                    // CLOSING ACCOUNT
                    Loan::where('byout_of',$request->id)->update(['status_id'=>7]);
                    return response()->json(['message'=>'success'],200);
                }else{
                    return response()->json(['message'=>'Invalid loan status'],422);
                }
            }else{
                return response()->json(['message'=>'Loan doesnt exists'],422);
            }
            
        }
    }

    public function view_for_approval(){
        return view($this->dir.'for_approval');
    }

    public function view_approved(){
        $charges = Charge::where('is_visible',1)->get();
        return view($this->dir.'approved',compact('charges'));
    }

    public function view_for_release(){
        $charges = Charge::where('is_visible',1)->get();
        return view($this->dir.'for_release',compact('charges'));
    }

    public function view_released(){
        $charges = Charge::where('is_visible',1)->get();
        return view($this->dir.'released',compact('charges'));
    }


    public function jsonData(Request $request){

        $data = Loan::whereHas('status',function($query) use($request){
                    $query->where('name',$request->status);
                })
                ->whereHas('client',function($query) use($request){
                    if($request->has('area_id')){
                        $query->where('area_id',$request->area_id);
                    }
                })
                ->with([
                    'client'=>function($query){
                        $query->with(['active_loan'=>function($query){
                            $query->with(['category','term','payment_mode']);
                        }]);
                    },
                    'schedule',
                    'payment',
                    'category',
                    'payment_mode',
                    'term'
                ])
                ->get();


        
        return LoanResource::collection($data);
    }

    public function jsonData1(Request $request){
        $client = new Client;
        if($request->has('loading_type')){
            if($request->search_text==''){
                return response()->json(['data'=>[]]);
            }
            $client = $client->where(function($query) use($request){
                $query->where('lname','LIKE','%'.$request->search_text.'%')->orWhere('fname','LIKE','%'.$request->search_text.'%')->orWhere('mname','LIKE','%'.$request->search_text.'%');
            });
        }
        if($request->has('table_type')){
            
            if($request->table_type=='payment'){
                
                if(!$request->has('area_id') && !$request->has('payment_mode_id')){
                    
                    return response()->json(['data'=>[]]);
                    
                }else{
                    if($request->has('area_id')){
                        $client = $client->where('area_id',$request->area_id);
                        // echo 'true';
                    }
                    
                    
                }
            }
        }
        
        $data = $client->whereHas('loan',function($query) use($request){
            
            if($request->has('table_type')){
                if($request->table_type=='payment'){
                    if($request->has('payment_mode_id')){
                        $query->where('payment_mode_id',$request->payment_mode_id)->where('status_id',6);
                    }
                }
            }else{
                $query->where('status_id','<>',7);
            }
        })
        ->with(
            [
                'co_maker'=>function($query){ 
                    $query->with(['co_maker_address'=>function($query){ 
                        $query->with([
                            'philippine_barangay'=>function($query){ 
                            $query->with(['philippine_city'=>function($query){ 
                                $query->with('philippine_barangay'); 
                            },
                            'philippine_province'=>function($query){ 
                                $query->with('philippine_city'); 
                            },
                            'philippine_region'
                        ]); 
                    }]); 
                }]); },
                'beneficiary',
                'deposit'=>function($query){ 
                    $query->with(['cbu','ps']); 
                },
                'withdraw'=>function($query){ 
                    $query->with(
                        [
                            'transaction'=>function($query){ $query->with('wallet'); }
                        ]
                    );
                },
                'loan'=>function($query){
                    $query->whereHas('status',function($query){ $query->whereNotIn('name',['CLOSED','DENIED']); })->with(['status','category','term','payment_mode','payment','schedule']);
                },
                'active_loan'=>function($query){
                    $query->with(['category','term','payment_mode','payment','schedule']);
                },
                'inactive_loan'=>function($query){
                    $query->with(['category','term','payment_mode','payment','schedule']);
                },
                'area',
                'address'=>function($query){ 
                            $query->with(
                                [
                                    'philippine_barangay'=>function($query){ 
                                        $query->with(
                                            [
                                                'philippine_city'=>function($query){ $query->with('philippine_barangay'); },
                                                'philippine_province'=>function($query){ $query->with('philippine_city'); },
                                                'philippine_region'
                                            ]
                                    ); }
                                ]
                        ); 
                    }
                ])
                ->get();
        
        return LoanResource::collection($data);
    }

    public function jsonDataGetReleases(Request $request){
        $data = Loan::whereDate('date_release',date('Y-m-d',strtotime($request->date_release)))
                    ->where('payment_mode_id',$request->payment_mode_id)
                    // ->join('clients','clients.id','=','loans.client_id')
                    // ->join('areas','areas.id','=','clients.area_id')
                    ->with(['client'=>function($query){ $query->with('area'); },'loan_charge'])
                    ->get();
                    // ->get([DB::raw("CONCAT(clients.lname,', ',clients.fname,' ',clients.mname) AS full_name"),'balance','loan_amount','areas.name']);
        return LoanResource::collection($data);
        
    }

    public function jsonActiveLoans(Request $request){
        $data = Loan::whereHas('status',function($query){ $query->where('name','RELEASED'); })
                    ->with('client')->get();
        return LoanResource::collection($data);
    }

    public function voucher($id){
        $loan = Loan::firstOrNew(['id'=>$id]);

        if($loan->exists){
            if(in_array($loan->status_id,[5,6]) && $loan->payment_mode_id!=1){
                $data = Loan::where('id',$id)->with([
                    'client'=>function($query){
                        $query->with([
                            'address'=>function($query){ 
                                    $query->with(
                                        [
                                            'philippine_barangay'=>function($query){ 
                                                $query->with(
                                                    [
                                                        'philippine_city'=>function($query){ $query->with('philippine_barangay'); },
                                                        'philippine_province'=>function($query){ $query->with('philippine_city'); },
                                                        'philippine_region'
                                                    ]
                                            ); }
                                        ]
                                ); 
                            }
                        ]);
                    },
                    'schedule',
                    'payment'
                ])->first();
                $view = \View::make('loans.voucher',compact('data'));
                $html = $view->render();
                PDF::SetTitle('Loan Voucher : '.$loan->transaction_code);
                PDF::AddPage();
                PDF::SetFont('times','N',12);
                PDF::writeHTML($html, true, false, true, false, '');
                PDF::Output('Loan Voucher : '.$loan->transaction_code.'.pdf');
            }else{
                if($loan->payment_mode_id==1){
                    echo 'Loan is included to DCR';
                }else{
                    echo 'Not yet generated a voucher';
                }
                
            }
        }else{
            abort(404);
        }
    }

    public function soa($id){
        $loan = Loan::firstOrNew(['id'=>$id]);

        if($loan->exists){
            if(in_array($loan->status_id,[6,7])){
                $data = Loan::where('id',$id)->with([
                    'client'=>function($query){
                        $query->with([
                            'address'=>function($query){ 
                                    $query->with(
                                        [
                                            'philippine_barangay'=>function($query){ 
                                                $query->with(
                                                    [
                                                        'philippine_city'=>function($query){ $query->with('philippine_barangay'); },
                                                        'philippine_province'=>function($query){ $query->with('philippine_city'); },
                                                        'philippine_region'
                                                    ]
                                            ); }
                                        ]
                                ); 
                            }
                        ]);
                    },
                    'schedule',
                    'payment'
                ])->first();
                $view = \View::make('loans.soa',compact('data'));
                $html = $view->render();
                PDF::SetTitle('SOA-#'.$loan->transaction_code);
                PDF::AddPage();
                PDF::SetFont('times','N',12);
                PDF::writeHTML($html, true, false, true, false, '');
                PDF::Output('SOA-#'.$loan->transaction_code.'.pdf');
            }else{
                echo 'Not yet generated soa';
            }
        }else{
            abort(404);
        }
    }

    public function sales_monitoring_pdf($payment_mode_id,$date){
        $loan=Loan::where(function($query) use($date){
                        $query->where('to_release_at',$date)->orWhere('date_release',$date);
                    })
                    ->where('payment_mode_id',$payment_mode_id)
                   ->whereHas('status',function($query){ 
                      $query->whereIn('name',['FOR RELEASE','RELEASED']); 
                   })
                   ->join('clients','clients.id','=','loans.client_id')
                   ->leftJoin('loan_charges','loan_charges.loan_id','=','loans.id')
                   ->select(['loans.*','clients.lname','clients.fname','clients.mname','clients.area_id',DB::raw('SUM(loan_charges.amount) AS total_deduction')])
                   ->groupBy('loan_charges.loan_id')
                   ->get()->toArray();
        
        $areas = Area::whereIn('id',array_unique(array_column($loan,'area_id')))->get();
        
        $data = [];
        
        foreach($areas as $area){
            $loan_filtered = array_filter($loan,function($arr) use($area){
                return $arr['area_id']==$area->id ? true : false;
            });
            array_push($data,[
                'area'=>$area->name,
                'loans'=>$loan_filtered
            ]);
        }

        
        $view = \View::make('loan.loans.sales_monitoring',compact('data','date','payment_mode_id'));
        $html = $view->render();
        PDF::SetTitle('SALES MONITORING');
        PDF::AddPage('L','LEGAL');
        PDF::SetFont('times','N',11);
        PDF::writeHTML($html, true, false, true, false, '');
        PDF::Output('SALES MONITORING-'.$date.'.pdf');
    }

    public function collection_report_pdf($payment_mode_id,$date){
        $payments = Payment::where('payment_date',$date)
                            ->join('clients','clients.id','=','payments.client_id')
                            ->leftJoin('addresses','addresses.client_id','=','clients.id')
                            ->leftJoin('dbsystem.philippine_barangays','dbsystem.philippine_barangays.id','=','addresses.philippine_barangay_id')
                            ->leftJoin('dbsystem.philippine_cities','dbsystem.philippine_cities.city_municipality_code','=','dbsystem.philippine_barangays.city_municipality_code')
                            ->leftJoin('dbsystem.philippine_provinces','dbsystem.philippine_provinces.province_code','=','dbsystem.philippine_cities.province_code')
                            ->leftJoin('transactions AS ps_transaction','ps_transaction.id','=','payments.ps_id')
                            ->leftJoin('transactions AS cbu_transaction','cbu_transaction.id','=','payments.cbu_id')
                            ->get(['payments.*',DB::raw("CONCAT(clients.lname,', ',clients.fname,' ',clients.mname) AS client_name"),'clients.area_id',DB::raw("CONCAT(street,', ',barangay_description,', ',city_municipality_description,', ',province_description) AS full_address")])->toArray();
        

        $areas = Area::whereIn('id',array_unique(array_column($payments,'area_id')))->get();
        
        $data = [];
        
        foreach($areas as $area){
            $payment_filtered = array_filter($payments,function($arr) use($area){
                return $arr['area_id']==$area->id ? true : false;
            });

            array_push($data,[
                'area'=>$area->name,
                'subdata'=>$payment_filtered
            ]);
        }

        

        $view = \View::make('loan.loans.collection_report',compact('data','date','payment_mode_id'));
        $html = $view->render();
        PDF::SetTitle('COLLECTION REPORT');
        PDF::AddPage('L','LEGAL');
        PDF::SetFont('times','N',11);
        PDF::writeHTML($html, true, false, true, false, '');
        PDF::Output('COLLECTION REPORT-'.$date.'.pdf');
    }
}
