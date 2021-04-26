<?php

namespace App\Models\DBLoans;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

    protected $fillable = ['client_id','category_id','term_id','payment_mode_id','status_id','transaction_code','date_loan','date_release','first_payment','maturity_date','loan_amount','interest','settled','balance','over','payment_per_sched','byout_of'];

    protected $appends = ['date_loan_formatted','date_release_formatted','first_payment_formatted','maturity_date_formatted','loan_amount_formatted'];

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
    
}
