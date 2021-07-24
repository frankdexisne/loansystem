<?php

namespace App\Http\Controllers\Loans;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DBLoans\Area;
use App\Http\Resources\Loans\AreaResource;
use App\Http\Requests\Loans\AreaRequest;
class AreaController extends Controller
{

    private $dir = 'loan.areas.';
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
    public function store(AreaRequest $request)
    {
        $data = Area::create($request->except('_token'));
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
    public function update(AreaRequest $request, $id)
    {
        Area::where('id',$id)->update($request->only('name'));
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
        $area = Area::findOrFail($id);
        if($area){
            $area->delete();
            return response()->json([
                'message'=>'Deleted!'
            ],200);
        }else{
            return response()->json([
                'message'=>'Record not exist'
            ],422);
        }
    }

    public function jsonData(Request $request){
        $data = null;
        if($request->has('reimburse_date')){
            $data = Area::where('for_daily_areas',$request->for_daily_areas)
                        ->with([
                            'reimbursement'=>function($query) use($request){ 
                                $query->whereDate('reimburse_date',date('Y-m-d',strtotime($request->reimburse_date))); 
                            }])
                            ->get();
        }else{
            if($request->has('for_daily_areas')){
                $data=Area::where('for_daily_areas',$request->for_daily_areas)->orderBy('for_daily_areas','ASC')->get();
            }else{
                $data = Area::get();
            }
        }
         
        return AreaResource::collection($data);
    }

    public function getNewAreaName($branch_id){
        $area = Area::where('branch_id',$branch_id);
        if($area->count()>0){
            
            return response()->json(['name'=>$area->orderBy('name','DESC')->first()->name+1]);
        }else{
            return response()->json(['name'=>1]);
        }
    }
}
