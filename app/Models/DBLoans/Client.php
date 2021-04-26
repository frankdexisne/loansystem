<?php

namespace App\Models\DBLoans;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Bavix\Wallet\Traits\HasWallet;
use Bavix\Wallet\Traits\HasWallets;
use Bavix\Wallet\Interfaces\Wallet;
class Client extends Model
{
    use HasFactory,HasWallet, HasWallets;
    
    protected $connection = 'mysql';

    protected $fillable = ['account_no','lname','fname','mname','dob','gender','contact_no','company','position','monthly_salary','area_id'];
    
    protected $appends = ['personal_saving','capital_build_up','loan_balance'];

    public function address(){
        return $this->hasOne('App\Models\DBLoans\Address');
    }

    public function area(){
        return $this->belongsTo('App\Models\DBLoans\Area');
    }

    public function beneficiary(){
        return $this->hasOne('App\Models\DBLoans\Beneficiary');
    }

    public function co_maker(){
        return $this->hasOne('App\Models\DBLoans\CoMaker');
    }

    public function getPersonalSavingAttribute(){
        return $this->hasWallet('ps') ? $this->getWallet('ps')->balance : 0;
    }

    public function getCapitalBuildUpAttribute(){
        return $this->hasWallet('cbu') ? $this->getWallet('cbu')->balance : 0;
    }

    public function loan(){
        return $this->hasMany('App\Models\DBLoans\Loan');
    }

    public function active_loan(){
        return $this->loan()->where('status_id',6)->orderBy('date_loan','DESC');
    }

    public function getLoanBalanceAttribute(){
        return $this->active_loan()->sum('balance');
    }

    public function inactive_loan(){
        return $this->loan()->where('status_id',7)->orderBy('date_loan','DESC');
    }

    public function deposit(){
        return $this->hasMany('App\Models\DBLoans\Payment')->whereNull('loan_id')->orderBy('payment_date','DESC');
    }

    public function withdraw(){
        return $this->hasMany('App\Models\DBLoans\Withdraw');
    }

    
}
