<?php

namespace App\Models\DBLoans;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

    protected $appends = ['schedule_date_formatted'];

    public function getScheduleDateFormattedAttribute(){
        return date('m/d/Y',strtotime($this->schedule_date));
    }

    public function loan(){
        return $this->belongsTo('App\Models\DBLoans\Loan');
    }
}
