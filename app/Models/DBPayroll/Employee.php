<?php

namespace App\Models\DBPayroll;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $connection = 'dbpayroll';

    protected $fillable = ['employee_no','avatar','lname','fname','mname','gender','job_title_id','branch_id'];

    public function job_title(){
        return $this->belongsTo('App\Models\DBPayroll\JobTitle');
    }

    public function branch(){
        return $this->belongsTo('App\Models\DBLoans\Branch');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function area(){
        return $this->belongsTo('App\Models\DBLoans\Area');
    }
}
