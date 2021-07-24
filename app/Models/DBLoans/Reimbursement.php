<?php

namespace App\Models\DBLoans;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reimbursement extends Model
{
    use HasFactory;
    
    protected $connection = 'mysql';

    protected $fillable = ['daily_transaction_report_id','area_id','employee_id','reimburse_date','created_at','updated_at'];

    protected $appends = ['total_collection'];

    public function payment(){
        return $this->hasMany('App\Models\DBLoans\Payment');
    }

    public function getTotalCollectionAttribute(){
        return number_format($this->payment->sum('amount'),2,'.',',');
    }
}
