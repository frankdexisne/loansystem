<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\DBLoans\Loan;
use App\Providers\LoanServiceProvider;
class LoanServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Loan::observe(LoanServiceProvider::class);
    }
}
