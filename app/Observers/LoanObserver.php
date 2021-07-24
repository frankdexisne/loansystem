<?php

namespace App\Observers;
use App\Models\DBLoans\Loan;
use App\Models\RecordLog;
use Auth;
class LoanObserver
{
    public function created(Loan $loan){
        RecordLog::create([
            'user_id'=>Auth::id(),
            'description'=>'Loan has been created by'.Auth::user()->name.' with transaction #'.$loan->transaction_code,
            'json_data'=>json_encode($loan->toArray()),
            'schema'=>'dbloans',
            'reference_no'=>$loan->transaction_code
        ]);
    }
    
    public function updating(Loan $loan){
        RecordLog::create([
            'user_id'=>Auth::id(),
            'description'=>'Loan has been changed by'.Auth::user()->name.' with transaction #'.$loan->transaction_code,
            'json_data'=>json_encode($loan->toArray()),
            'schema'=>'dbloans',
            'reference_no'=>$loan->transaction_code
        ]);
    }

    public function updated(Loan $loan){
        RecordLog::create([
            'user_id'=>Auth::id(),
            'description'=>'Loan has been changed by'.Auth::user()->name.' with transaction #'.$loan->transaction_code,
            'json_data'=>json_encode($loan->toArray()),
            'schema'=>'dbloans',
            'reference_no'=>$loan->transaction_code
        ]);
    }

    public function deleting(Loan $loan){
        RecordLog::create([
            'user_id'=>Auth::id(),
            'description'=>'Loan has been changed by'.Auth::user()->name.' with transaction #'.$loan->transaction_code,
            'json_data'=>json_encode($loan->toArray()),
            'schema'=>'dbloans',
            'reference_no'=>$loan->transaction_code
        ]);
    }

    public function deleted(Loan $loan){
        RecordLog::create([
            'user_id'=>Auth::id(),
            'description'=>'Loan has been changed by'.Auth::user()->name.' with transaction #'.$loan->transaction_code,
            'json_data'=>json_encode($loan->toArray()),
            'schema'=>'dbloans',
            'reference_no'=>$loan->transaction_code
        ]);
    }
}
