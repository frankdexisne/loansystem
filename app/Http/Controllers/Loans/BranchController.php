<?php

namespace App\Http\Controllers\Loans;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Loans\BranchRequest;
use App\Models\DBLoans\Branch;
use App\Http\Resources\Loans\BranchResource;
class BranchController extends Controller
{
    private $dir = 'loan.branches.';
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
    public function store(BranchRequest $request)
    {
        $data = Branch::create($request->only('name'));
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
    public function update(BranchRequest $request, $id)
    {
        Branch::where('id',$id)->update($request->only('name'));
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
        $branch = Branch::firstOrNew(['id'=>$id]);
        if($branch->exists){
            Branch::where('id',$id)->delete();
            return response()->json(['message'=>'Deleted'],200);
        }else{
            abort(404);
        }
    }

    public function jsonData(Request $request){
        $data = Branch::get();
        return BranchResource::collection($data);
    }

    public function submit_fund(Request $request){
        $http_code=200;
        $message='';
        $type='';
        $branch = getWorkStation()->branch;
        if($request->payment_mode_id==1){
            if($branch->hasWallet('daily_coh')==false){
                $branch->createWallet([
                    'name' => 'DAILY CASH ON HAND',
                    'slug' => 'daily_coh'
                ]);
            }
            $wallet_coh = $branch->getWallet('daily_coh');
            $deposit_coh=$wallet_coh->deposit($request->fund);
            $message="Successfully deposited";
            $type="success";
        }else{
            if($branch->hasWallet('weekly_coh')==false){
                $branch->createWallet([
                    'name' => 'WEEKLY CASH ON HAND',
                    'slug' => 'weekly_coh'
                ]);
            }
            $wallet_coh = $branch->getWallet('weekly_coh');
            $deposit_coh=$wallet_coh->deposit($request->fund);
            $message="Successfully deposited";
            $type="success";
        }
        return response()->json([
            'message'=>$message,
            'type'=>$type
        ],$http_code);
    }
}
