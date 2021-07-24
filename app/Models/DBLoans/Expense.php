<?php

namespace App\Models\DBLoans;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

    protected $fillable = ['expense_type_id','expense_date','ornos','employee_id','description','amount','payment_mode_id'];

    public function employee(){
        return $this->belongsTo('App\Models\DBPayroll\Employee');
    }
    public function expense_type(){
        return $this->belongsTo('App\Models\DBLoans\ExpenseType');
    }
}
