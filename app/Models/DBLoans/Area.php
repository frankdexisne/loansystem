<?php

namespace App\Models\DBLoans;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    
    protected $fillable = ['branch_id','name'];

    public function reimbursement(){
        return $this->hasMany('App\Models\DBLoans\Reimbursement');
    }

    public function client(){
        return $this->hasMany('App\Models\DBLoans\Client');
    }
}
