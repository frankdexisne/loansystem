<?php
    use App\Models\WorkStation;
    use App\Models\DBLoans\Branch;
    use App\Models\DBPayroll\Employee;
    use Illuminate\Support\Facades\Cookie;

    if(!function_exists("getWorkStation")){
        function getWorkStation(){
            $workstation = Cookie::get('workstation');
            return Workstation::where(['encrypted_ws'=>$workstation])->with(['branch'])->first();
        }
    }

    if(!function_exists("getBranchCashier")){
        function getBranchCashier(){
            $employee = Employee::where('branch_id',getWorkStation()->branch_id)->whereHas('job_title',function($query){
                $query->where('name','CASHIER');
            })->first();

            return $employee!=null ? $employee->lname.', '.$employee->fname.' '.$employee->mname : '';
        }
    }

    if(!function_exists("getBranchSecretary")){
        function getBranchSecretary(){
            $employee = Employee::where('branch_id',getWorkStation()->branch_id)->whereHas('job_title',function($query){
                $query->where('name','SECRETARY');
            })->first();

            return $employee!=null ? $employee->lname.', '.$employee->fname.' '.$employee->mname : '';
        }
    }

    if(!function_exists("getBranchManager")){
        function getBranchManager(){
            $employee = Employee::where('branch_id',getWorkStation()->branch_id)->whereHas('job_title',function($query){
                $query->where('name','MANAGER');
            })->first();

            return $employee!=null ? $employee->lname.', '.$employee->fname.' '.$employee->mname : '';
        }
    }

?>