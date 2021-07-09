<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\DBLoans\Branch;
use Cookie;
use App\Models\Workstation;
use App\Models\DBLoans\Loan;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $branch = getWorkStation()->branch;
        
        if($branch->hasWallet('daily_coh')==false){
            $branch->createWallet([
                'name' => 'DAILY CASH ON HAND',
                'slug' => 'daily_coh'
            ]);
        }
        if($branch->hasWallet('weekly_coh')==false){
            $branch->createWallet([
                'name' => 'WEEKLY CASH ON HAND',
                'slug' => 'weekly_coh'
            ]);
        }
        $coh_daily = $branch->getWallet('daily_coh') ? $branch->getWallet('daily_coh')->balance : 0;
        $coh_weekly = $branch->getWallet('weekly_coh') ? $branch->getWallet('weekly_coh')->balance : 0;
        
        return view('home',compact('coh_daily','coh_weekly'));
        // dd(Loan::where('id',7)->with('loan_charge')->first());
    }

    public function profile()
    {
        $data = User::where('id',Auth::user()->id)->with('employee')->first();
        return view('auth.profile',compact('data'));
        
    }
}
