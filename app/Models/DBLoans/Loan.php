<?php

namespace App\Models\DBLoans;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

    protected $fillable = ['client_id','category_id','term_id','payment_mode_id','status_id','transaction_code','date_loan','date_release','first_payment','maturity_date','loan_amount','interest','settled','balance','over','payment_per_sched','byout_of'];

    protected $appends = ['date_loan_formatted','date_release_formatted','first_payment_formatted','maturity_date_formatted','loan_amount_formatted','balance_formatted','deduction_formatted','ps_formatted','cbu_formatted','total_byout_formatted'];

    public function client(){
        return $this->belongsTo('App\Models\DBLoans\Client');
    }

    public function term(){
        return $this->belongsTo('App\Models\DBLoans\Term');
    }

    public function payment_mode(){
        return $this->belongsTo('App\Models\DBLoans\PaymentMode');
    }

    public function category(){
        return $this->belongsTo('App\Models\DBLoans\Category');
    }

    public function status(){
        return $this->belongsTo('App\Models\DBLoans\Status');
    }

    public function payment(){
        return $this->hasMany('App\Models\DBLoans\Payment');
    }
    
    public function schedule(){
        return $this->hasMany('App\Models\DBLoans\Schedule');
    }

    public function loan_charge(){
        return $this->hasMany('App\Models\DBLoans\LoanCharge');
    }

    public function byout(){
        return $this->hasMany('App\Models\DBLoans\Loan','byout_of','id');
    }

    public function ps(){
        return $this->hasOne('App\Models\DBLoans\Transaction','id','ps_id');
    }

    public function cbu(){
        return $this->hasOne('App\Models\DBLoans\Transaction','id','cbu_id');
    }

    public function getTotalByoutFormattedAttribute(){
        return number_format($this->byout->sum('balance'),2,'.',',');
    }


    public function getPsFormattedAttribute(){
        $amount = $this->ps!=null ? $this->ps->amount : 0;
        return number_format($amount,2,'.',',');
    }

    public function getCbuFormattedAttribute(){
        $amount = $this->cbu!=null ? $this->cbu->amount : 0;
        return number_format($amount,2,'.',',');
    }

    
    public function getDeductionFormattedAttribute(){
        return number_format($this->loan_charge->sum('amount'),2,'.',',');
    }

    public function getDateLoanFormattedAttribute(){
        return date('m/d/Y',strtotime($this->date_loan));
    }

    public function getFirstPaymentFormattedAttribute(){
        return $this->first_payment!=null ? date('m/d/Y',strtotime($this->first_payment)) : '';
    }

    public function getMaturityDateFormattedAttribute(){
        return $this->maturity_date!=null ? date('m/d/Y',strtotime($this->maturity_date)) : '';
    }

    public function getDateReleaseFormattedAttribute(){
        return $this->date_release!=null ? date('m/d/Y',strtotime($this->date_release)) : '';
    }

    public function getLoanAmountFormattedAttribute(){
        return number_format($this->loan_amount,2,'.',',');
    }

    public function getBalanceFormattedAttribute(){
        return number_format($this->balance,2,'.',',');
    }
    
}
