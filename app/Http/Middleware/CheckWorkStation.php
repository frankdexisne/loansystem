<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Cookie;
use Session;
use Illuminate\Http\Response;
use App\Traits\AuthenticationCode;
use Crypt;
use App\Models\Workstation;
use Illuminate\Support\Str;

class CheckWorkStation
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $generated_code = Str::random(4).'-'.Str::random(4).'-'.Str::random(4).'-'.Str::random(4);
        $encrypted_ws = !Cookie::get('workstation') ? Crypt::encrypt(strtoupper($generated_code)) : Cookie::get('workstation');
        $workstation_name = Crypt::decrypt($encrypted_ws);
        $workstation=Workstation::firstOrNew(['encrypted_ws'=>$encrypted_ws]);
        if($workstation->exists){
            if($workstation->allowed==1 && $workstation->branch_id!=null){
                return $next($request);
            }else{
                return response(view('workstation',compact('workstation_name','encrypted_ws','workstation')),200);
            }
        }else{
            $workstation->fill([
                'workstation_name'=>$workstation_name,
                'workstation_description'=>'_gateway'
            ])->save();
            return response(view('workstation',compact('workstation_name','encrypted_ws','workstation')),200)
                    ->withCookie(cookie()->forever('workstation', $encrypted_ws));
        }
    }
}
