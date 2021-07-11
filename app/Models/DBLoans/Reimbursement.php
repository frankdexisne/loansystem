<?php

namespace App\Models\DBLoans;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reimbursement extends Model
{
    use HasFactory;
    
    protected $connection = 'mysql';

    protected $fillable = ['daily_transaction_report_id','area_id','reimburse_date','created_at','updated_at'];
}
