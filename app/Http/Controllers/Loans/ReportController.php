<?php

namespace App\Http\Controllers\Loans;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DBLoans\Payment;
use App\Models\DBLoans\Schedule;
use App\Models\DBLoans\Client;
use App\Models\DBLoans\Loan;
use App\Models\DBLoans\Withdraw;
use App\Models\DBLoans\Expense;
use Carbon\Carbon;
class ReportController extends Controller
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

    public function ncr(){
        
        return view('reports.note_collection_report');
    }

    public function count_date_diff($start,$end){
        $count = 0;
        $preset = date("Y-m-d",strtotime($start));
        while($preset<=$end){
            $count+=1;
            $preset = date("Y-m-d",strtotime($start.' + 1days'));
        }
        return $count;
    }

    public function ncr_json(Request $request){
        $start_date = $request->cutoff_date=="t" ? "24" : ( $request->cutoff_date=="23" ? "16" : ($request->cutoff_date=="15" ? "08" : "01"));
        $start_daterange = $request->cutoff_month.'-'.$start_date;
        $end_daterange = $request->cutoff_month.'-'.date($request->cutoff_date);
        
        $start = date_create($start_daterange);
        $end = date_create($end_daterange);

        $diff_days=date_diff($start,$end)->days;
        $days = [null,null,null,null,null,null,null,null];
        $titles = [null,null,null,null,null,null,null,null];
        $loop_date = date('Y-m-d',strtotime($start_daterange));
        for($i=0; $i<=$diff_days;$i++){
            if($loop_date<=date('Y-m-d',strtotime($end_daterange))){
                $days[$i]=$loop_date;
                $titles[$i]=date('m-d',strtotime($loop_date));
            }
            $loop_date = date('Y-m-d',strtotime($loop_date.'+ 1 days'));
        }
        
        
        $clients = Client::where('area_id',$request->area_id)
                         ->whereHas('loan',function($query) use($start_daterange,$end_daterange){ 
                             $query->where('payment_mode_id',1)->where('status_id',[6,7]);
                                //    ->whereHas('payment',function($query) use($start_daterange,$end_daterange){ 
                                //        $query->whereBetween('payment_date',[$start_daterange,$end_daterange]); 
                                //     }); 
                            })
                            ->with('loan')
                            ->orderBy('lname','ASC')
                            ->get();
        
        $data = [];
        foreach($clients as $client){
            foreach($client->loan as $loan){
                $current_startdate = $loan->first_payment<$start_daterange ? date('d',strtotime($start_daterange)) : null;
                $overdue = 0;
                if($current_startdate!=null){
                    $prev_enddate =  $current_startdate=="01" ? "t" : ( $current_startdate=="24" ? "23" : ($current_startdate=="16" ? "15" : "07"));
                    $prev_end_daterange = $prev_enddate=="t" ? date('Y-m-t',strtotime($request->cutoff_month.'- 1 month')) :  $request->cutoff_month.'-'.$prev_enddate;
                    $prev_end_daterange_formatted = date('d',strtotime($prev_end_daterange));
                    $prev_start_daterange = $prev_end_daterange_formatted=="07" ? "01" : ( $prev_end_daterange_formatted=="15" ? "08" : ($prev_enddate=="23" ? "16" : "24"));
                    $prev_start_daterange = $prev_start_daterange=="24" ? date('Y-m-24',strtotime($request->cutoff_month.'- 1 month')) :  $request->cutoff_month.'-'.$prev_start_daterange;
                    $prev_start = $loan->first_payment>$prev_start_daterange ? date_create($loan->first_payment) : date_create($prev_start_daterange);
                    $prev_end = date_create($prev_end_daterange);
                    $prev_diff_days=date_diff($prev_start,$prev_end)->days;
                    $prev_due = ($prev_diff_days+1)*$loan->payment_per_sched;
                    $prev_total = Payment::where('loan_id',$loan->id)->whereBetween('payment_date',[$prev_start_daterange,$prev_end_daterange])->sum('amount');
                    
                    $prev_overall_total = Payment::where('loan_id',$loan->id)->where('payment_date','<',$prev_start_daterange)->sum('amount');
                    $first_payment_datediff = date_diff(date_create(date('Y-m-d',strtotime($loan->first_payment))),date_create(date('Y-m-d',strtotime($prev_start_daterange.'- 1 days'))))->days;
                    $prev_overall_target = ($first_payment_datediff+1) * $loan->payment_per_sched;
                    $overdue = $prev_due > $prev_total ? $prev_due-$prev_total : 0;
                    if($loan->first_payment<$prev_start_daterange){
                        if($prev_overall_target>$prev_overall_total){
                            $overdue = $overdue + ($prev_overall_target-$prev_overall_total);
                        }
                    }
                    
                }

                
                $payments = Payment::where('loan_id',$loan->id)->whereBetween('payment_date',[$start_daterange,$end_daterange])->get()->toArray();
                $current_start = $loan->first_payment>$start_daterange ? date_create($loan->first_payment) : date_create($start_daterange);
                $current_diff_days=date_diff($current_start,$end)->days;
                $due = ($current_diff_days+1)*$loan->payment_per_sched;
                $total = Payment::where('loan_id',$loan->id)->whereBetween('payment_date',[$start_daterange,$end_daterange])->sum('amount');
                $prev_payments = Payment::where('loan_id',$loan->id)->where('payment_date','<',$start_daterange);
                $prev_payments_total = $prev_payments->sum('amount');
                $current_target=($prev_payments->count()*$loan->payment_per_sched)+(($current_diff_days+1)*$loan->payment_per_sched);
                // $overdue = $current_target>($prev_payments_total+$due) ? $current_target-($prev_payments_total+$due) : 0;
                
                $last_payment_date = Payment::where('loan_id',$loan->id)->orderBy('payment_date','DESC')->first();
                $last_payment_date = $last_payment_date!=null ? $last_payment_date->payment_date : null;
                $maturity_date = date_create($loan->maturity_date);
                $now = date('Y-m-d',strtotime(Carbon::now()));
                $end_range = date('Y-m-d',strtotime($end_daterange));
                
                $dcd = $now<=$end_range ? date_diff($end,$maturity_date)->days : date_diff(date_create($now),$maturity_date)->days;
                
                $d1 = array_filter($payments,function($obj) use($days){return $obj['payment_date']==$days[0];});
                $d2 = array_filter($payments,function($obj) use($days){return $obj['payment_date']==$days[1];});
                $d3 = array_filter($payments,function($obj) use($days){return $obj['payment_date']==$days[2];});
                $d4 = array_filter($payments,function($obj) use($days){return $obj['payment_date']==$days[3];});
                $d5 = array_filter($payments,function($obj) use($days){return $obj['payment_date']==$days[4];});
                $d6 = array_filter($payments,function($obj) use($days){return $obj['payment_date']==$days[5];});
                $d7 = array_filter($payments,function($obj) use($days){return $obj['payment_date']==$days[6];});
                $d8 = array_filter($payments,function($obj) use($days){return $obj['payment_date']==$days[7];});

                array_push($data,[
                    'id'=>$loan->id,
                    'client_name' => $client->lname.', '.$client->fname.' '.$client->mname,
                    'd1'=>$days[0]!=null ? ($d1!=null ? $d1[0]['amount'] : null) : null,
                    'd2'=>$days[1]!=null ? ($d2!=null ? $d2[0]['amount'] : null) : null,
                    'd3'=>$days[2]!=null ? ($d3!=null ? $d3[0]['amount'] : null) : null,
                    'd4'=>$days[3]!=null ? ($d4!=null ? $d4[0]['amount'] : null) : null,
                    'd5'=>$days[4]!=null ? ($d5!=null ? $d5[0]['amount'] : null) : null,
                    'd6'=>$days[5]!=null ? ($d6!=null ? $d6[0]['amount'] : null) : null,
                    'd7'=>$days[6]!=null ? ($d7!=null ? $d7[0]['amount'] : null) : null,
                    'd8'=>$days[7]!=null ? ($d8!=null ? $d8[0]['amount'] : null) : null,
                    'total'=>$total,
                    'due'=>$due,
                    'overdue'=>$overdue,
                    'current_balance'=>0,
                    'daily'=>$loan->payment_per_sched,
                    'lpd'=>$last_payment_date,
                    'dcd'=>$dcd
                ]);
            }
        }
        // dd($data);
        return response()->json(['data'=>$data,'titles'=>$titles]);
        
        
        
    }

    public function tpr(){
        return view('reports.target_performance_report');
    }

    public function cr(){
        return view('reports.collection_report');
    }

    public function cr_json(Request $request){
        $data = [];
        $data_with_loan = Payment::whereBetween('payment_date',[$request->start_date,$request->end_date])
                       ->whereHas('loan')
                       ->with([
                           'loan'=>function($query) use($request){
                               $query->with([
                                   'client'=>function($query) use($request){
                                       $query->with(['address'=>function($query){ $query->with('philippine_barangay',function($query){ $query->with(['philippine_city','philippine_province','philippine_region']); }); }]);
                                       if($request->has('area_id')){
                                           $query->where('area_id',$request->area_id);
                                       }
                                   }
                                ]);
                           },
                           'ps',
                           'cbu'
                       ])
                       
                       ->get();
        

        $data = Payment::whereBetween('payment_date',[$request->start_date,$request->end_date])
                        ->whereNull('loan_id')
                        ->whereHas('client',function($query) use($request){
                            if($request->has('area_id')){
                                $query->where('area_id',$request->area_id);
                            }
                        })
                        ->with(['client','ps','cbu'])
                        ->get()->toArray();
        
        foreach($data_with_loan as $key=>$row){
            array_push($data,[
                "id" => $row->id,
                "client_id" => $row->client_id,
                "loan_id" => $row->loan_id,
                "orno" => $row->orno,
                "payment_date" => $row->payment_date,
                "amount" => $row->amount,
                "ps_id" => $row->ps_id,
                "cbu_id" => $row->cbu_id,
                "ins_id" => $row->ins_id,
                'penalty'=>$row->penalty,
                "created_at" => $row->created_at,
                "updated_at" => $row->updated_at,
                "payment_date_formatted" => date('m/d/Y',strtotime($row->payment_date)),
                "amount_formatted" => number_format($row->amount,2,'.',','),
                "ps_amount" => $row->ps!=null ? number_format($row->ps->amount,2,'.',',') : number_format(0,2,'.',','),
                "cbu_amount" => $row->cbu!=null ? number_format($row->cbu->amount,2,'.',',') : number_format(0,2,'.',','),
                "ins_amount" => $row->ins!=null ? number_format($row->ins->amount,2,'.',',') : number_format(0,2,'.',','),
                'client'=>$row->loan->client,
                'ps'=>$row->ps,
                'cbu'=>$row->cbu
            ]);
        }
                        
        
        
        return response()->json(['data'=>$data]);
    }

    public function cs(){
        return view('reports.collection_schedule');
    }
    public function cs_json(Request $request){
        $data = Schedule::whereBetween('schedule_date',[$request->start_date,$request->end_date])
                       ->whereHas('loan')
                       ->with([
                           'loan'=>function($query) use($request){
                               $query->with([
                                   'client'=>function($query) use($request){
                                       if($request->has('area_id')){
                                           $query->where('area_id',$request->area_id);
                                       }
                                   }
                                ]);
                           }
                       ])
                       ->get();
        return response()->json(['data'=>$data->toArray()]);
    }

    public function sr(){
        return view('reports.sales_report');
    }

    public function sr_json(Request $request){
        $data = Loan::whereBetween('release_date',[$request->start_date,$request->end_date])
                       ->whereHas('client')
                       ->with([
                            'client'=>function($query) use($request){
                                if($request->has('area_id')){
                                    $query->where('area_id',$request->area_id);
                                }
                            }
                       ])
                       ->get();
        return response()->json(['data'=>$data->toArray()]);
    }

    public function lr(){
        return view('reports.loan_report');
    }

    public function lr_json(Request $request){
        $data = Loan::whereBetween('release_date',[$request->start_date,$request->end_date])
                       ->whereHas('client')
                       ->with([
                            'client'=>function($query) use($request){
                                if($request->has('area_id')){
                                    $query->where('area_id',$request->area_id);
                                }
                            }
                       ])
                       ->get();
        return response()->json(['data'=>$data->toArray()]);
    }

    public function wr(){
        return view('reports.withdrawal_report');
    }

    public function wr_json(Request $request){
        $data = Withdraw::whereBetween('withdraw_date',[$request->start_date,$request->end_date])
                       ->whereHas('client')
                       ->with([
                            'client'=>function($query) use($request){
                                if($request->has('area_id')){
                                    $query->where('area_id',$request->area_id);
                                }
                            }
                       ])
                       ->get();
        return response()->json(['data'=>$data->toArray()]);
    }

    public function er(){
        return view('reports.expense_report');
    }

    public function er_json(Request $request){
        $data = Expense::whereBetween('expense_date',[$request->start_date,$request->end_date])
                       ->whereHas('employee')
                       ->with([
                            'employee'=>function($query) use($request){
                                if($request->has('branch_id')){
                                    $query->where('branch_id',$request->branch_id);
                                }
                            }
                       ])
                       ->get();
        return response()->json(['data'=>$data->toArray()]);
    }

}
