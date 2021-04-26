<?php

namespace App\Models\DBLoans;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

    protected $fillable = ['client_id','loan_id','orno','payment_date','amount','ps_id','cbu_id','ins_id'];

    protected $appends = ['payment_date_formatted','amount_formatted','ps_amount','cbu_amount'];

    public function ps(){
        return $this->hasOne('App\Models\DBLoans\Transaction','id','ps_id');
    }

    public function cbu(){
        return $this->hasOne('App\Models\DBLoans\Transaction','id','cbu_id');
    }

    public function getPaymentDateFormattedAttribute(){
        return date('m/d/Y',strtotime($this->payment_date));
    }

    public function getAmountFormattedAttribute(){
        return number_format($this->amount,2,'.',',');
    }

    public function getPsAmountAttribute(){
        return $this->ps_id!=null ? number_format($this->ps->amount,2,'.',',') : 0;
    }

    public function getCbuAmountAttribute(){
        return $this->ps_id!=null ? number_format($this->ps->amount,2,'.',',') : 0;
    }

}
