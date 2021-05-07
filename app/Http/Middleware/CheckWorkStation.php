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


class CheckWorkStation
{
    use AuthenticationCode;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!Cookie::get('workstation')){
            $code_generated = $this->codeGenerate();
            $workstation = Workstation::firstOrNew(['workstation_name'=>$code_generated]);
            if(!$workstation->exists){
                
                
                $workstation->fill([
                    'workstation_description'=>'_gateway',
                    'encrypted_ws'=>Crypt::encrypt($code_generated)
                ])->save();
            }
            // return response(view('workstation',compact('code_generated','workstation')),200)->cookie('workstation',Crypt::encrypt($code_generated));
            return response(view('workstation',compact('code_generated','workstation')),200)
                            ->withCookie(cookie()->forever('workstation', Crypt::encrypt($code_generated)));
            
        }else{
            $code_generated = Crypt::decrypt(Cookie::get('workstation'));
            $workstation = Workstation::firstOrNew(['workstation_name'=>$code_generated]);
            if(!$workstation->exists){
                $workstation->fill([
                    'workstation_description'=>'_gateway',
                    'encrypted_ws'=>Crypt::encrypt($code_generated)
                ])->save();
            }
            
            if($workstation->allowed==1){
                return $next($request);
            }else{
                return response(view('workstation',compact('code_generated','workstation')),200);
            }
            
        }
    }
}
