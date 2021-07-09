<?php

namespace App\Http\Controllers\Loans;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DBLoans\Client;
use App\Models\DBLoans\Address;
use App\Models\DBLoans\Beneficiary;
use App\Models\DBLoans\CoMaker;
use App\Models\DBLoans\CoMakerAddress;
use App\Models\DBLoans\Loan;
use App\Models\DBLoans\Schedule;
use App\Models\DBLoans\Payment;
use App\Models\DBLoans\Withdraw;
use App\Models\DBLoans\Status;
use App\Http\Resources\Loans\ClientResource;
use App\Http\Requests\Loans\ClientUpdateRequest;
use App\Http\Requests\Loans\BeneficiaryUpdateRequest;
use App\Http\Requests\Loans\CoMakerUpdateRequest;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Auth;
use DB;
class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('clients.index');
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

        
        $client = [
            'account_no'=>'S-'.date('y',strtotime(Carbon::now())).Str::random(5),
            'avatar'=>'avatar_2x.png',
            'lname'=>html_entity_decode($request->client['lname']),
            'fname'=>html_entity_decode($request->client['fname']),
            'mname'=>html_entity_decode($request->client['mname']),
            'dob'=>html_entity_decode($request->client['dob']),
            'gender'=>html_entity_decode($request->client['gender']),
            'contact_no'=>html_entity_decode($request->client['contact_no']),
            'company'=>html_entity_decode($request->client['company']),
            'position'=>html_entity_decode($request->client['position']),
            'monthly_salary'=>html_entity_decode($request->client['monthly_salary']),
            'street'=>html_entity_decode($request->client['street']),
            'area_id'=>html_entity_decode($request->client['area_id']),
            'group_id'=>null,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>null,
        ];
        
        
        DB::transaction(function() use($client,$request){

            try{
                $createClient = Client::create($client);
                $createClientAddress = Address::create([
                    'client_id'=>$createClient->id,
                    'philippine_barangay_id'=>$request->client['barangay_id'],
                    'street'=>$request->client['street'],
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>null,
                ]);

                $coMakerData = CoMaker::firstOrNew(['lname' => $request->co_maker['lname'],'fname' => $request->co_maker['fname'],'mname' => $request->co_maker['mname'],'client_id'=>$createClient->id]);
                
                if(!$coMakerData->exists){
                    $coMakerData->fill([
                        'dob'=>'1992-10-16',
                        // 'dob'=>html_entity_decode(date('Y-m-d',($request->co_maker['dob']))),
                        'gender'=>html_entity_decode($request->co_maker['gender']),
                        'contact_no'=>html_entity_decode($request->co_maker['contact_no']),
                        'company'=>html_entity_decode($request->co_maker['company']),
                        'position'=>html_entity_decode($request->co_maker['position']),
                        'monthly_salary'=>html_entity_decode($request->co_maker['monthly_salary']),
                        'street'=>html_entity_decode($request->co_maker['street'])
                    ])->save();
                }

                $createCoMakerAddress = CoMakerAddress::create([
                    'co_maker_id'=>$coMakerData->id,
                    'philippine_barangay_id'=>$request->co_maker['barangay_id'],
                    'street'=>$request->co_maker['street'],
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>null,
                ]);

                

                $beneficiaryData = Beneficiary::firstOrNew(['lname' => $request->beneficiary['lname'],'fname' => $request->beneficiary['fname'],'mname' => $request->beneficiary['mname'],'client_id'=>$createClient->id]);
                if(!$beneficiaryData->exists){
                    $beneficiaryData->fill([
                        'gender'=>html_entity_decode($request->beneficiary['gender']),
                        'relationship_id'=>html_entity_decode($request->beneficiary['relationship_id']),
                    ])->save();
                }

                
                $status = Status::where('name','FOR APPROVAL')->first();

                

                $loan = [
                    'client_id'=>$createClient->id,
                    'area_id'=>html_entity_decode($request->client['area_id']),
                    'transaction_code'=>$createClient->account_no.'-'.date('Ymd'),
                    'category_id'=>html_entity_decode($request->loan['category_id']),
                    'term_id'=>html_entity_decode($request->loan['term_id']),
                    'payment_mode_id'=>html_entity_decode($request->loan['payment_mode_id']),
                    'loan_amount'=>html_entity_decode($request->loan['loan_amount']),
                    'interest'=>html_entity_decode($request->loan['interest']),
                    'date_loan'=>date('Y-m-d'),
                    'group_id'=>$createClient->group_id,
                    'status_id'=>$status->id,
                    'settled'=>0,
                    'balance'=>0,
                    'over'=>0,
                    'payment_per_sched'=>0,
                ];

                $createLoan = Loan::create($loan);


                


            }catch(Exception $e){
                DB::rollBack();
            }

        });



        $title = "Success!";
        $message = "Client has been added";
        $type="success";
        return response()->json(['title'=>$title,'message'=>$message,'type'=>$type],200);
        
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
    public function update(ClientUpdateRequest $request, $id)
    {
        Client::where('id',$id)->update($request->except('_token','philippine_barangay_id','city_id','street'));
        Address::where('client_id',$id)->update($request->only('philippine_barangay_id','street'));
        return response()->json(['message'=>'Success']);
    }

    public function beneficiary_update(BeneficiaryUpdateRequest $request, $id)
    {
        Beneficiary::where('client_id',$id)->update($request->except('_token'));
        return response()->json(['message'=>'Success']);
    }

    public function co_maker_update(CoMakerUpdateRequest $request, $id)
    {
        
        CoMaker::where('client_id',$id)->update($request->except('_token','philippine_barangay_id','city_id','street','co_maker_id'));
        CoMakerAddress::where('co_maker_id',$request->co_maker_id)->update($request->only('philippine_barangay_id','street','co_maker_id'));
        return response()->json(['message'=>'Success']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::firstOrNew(['id'=>$id]);
        
        if($client->exists){
            // Address::where('client_id',$id)->delete();
            // Beneficiary::where('client_id',$id)->delete();
            // $co_maker = CoMaker::where('client_id',$id);
            // CoMakerAddress::where('co_maker_id',$co_maker->first()->id)->delete();
            // $co_maker->delete();
            // Client::where('id',$id)->delete();
            
            return response()->json(['message'=>'Deleting client is not available'],200);
        }else{
            abort(404);
        }
    }

    

    public function jsonData(Request $request){
        $client = new Client;
        if($request->has('loading_type')){
            if($request->search_text==''){
                return response()->json(['data'=>[]]);
            }
            $client = $client->where(function($query) use($request){
                $query->where('lname','LIKE','%'.$request->search_text.'%')->orWhere('fname','LIKE','%'.$request->search_text.'%')->orWhere('mname','LIKE','%'.$request->search_text.'%');
            });
        }
        $data = $client->with(
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
                'active_loan'=>function($query){
                    $query->with(['category','term','payment_mode','payment','schedule','status']);
                },
                'inactive_loan'=>function($query){
                    $query->with(['category','term','payment_mode','payment','schedule','status']);
                },
                'in_process_loan'=>function($query){
                    $query->with(['category','term','payment_mode','payment','schedule','status']);
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
        return ClientResource::collection($data);
        
        
        
    }
}
