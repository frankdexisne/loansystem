<?php
    use App\Models\WorkStation;
    use App\Models\DBLoans\Branch;
    use Illuminate\Support\Facades\Cookie;
    if(!function_exists("getWorkStation")){
        function getWorkStation(){
            $workstation = Cookie::get('workstation');
            return Workstation::where(['encrypted_ws'=>$workstation])->with(['branch'])->first();
        }
    }

    // if(!function_exists("getBranchWallet")){
    //     function getBranchWallet(){
            
    //     }
    // }
?>