<?php

namespace App\Http\Controllers\Loans;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Loans\TermRequest;
use App\Models\DBLoans\Term;
use App\Http\Resources\Loans\TermResource;
class TermController extends Controller
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
    public function store(TermRequest $request)
    {
        Term::create($request->only('no_of_months'));
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
    public function update(TermRequest $request, $id)
    {
        Term::where('id',$id)->update($request->only('no_of_months'));
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
        $term = Term::firstOrNew(['id'=>$id]);
        if($term->exists){
            Term::where('id',$id)->delete();
            return response()->json(['message'=>'Deleted'],200);
        }else{
            abort(404);
        }
    }

    public function jsonData(Request $request){
        $data = $request->has('filter') ? ($request->daily_only==1 ? Term::where('daily_only',1)->get() : Term::where('daily_only',0)->get()) : Term::get();
        return TermResource::collection($data);
    }
}
