<?php

namespace App\Providers;

use App\Account;
use App\Transaction;
use App\Observers\AccountObserver;
use App\Observers\TransactionObserver;
use App\Observers\UserObserver;
use App\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // For Mysql versions before 5.7
        Schema::defaultStringLength(191);

        // Models' events observers -- Should be commented when using seeding or factory
        User::observe(UserObserver::class);
        Account::observe(AccountObserver::class);
        Transaction::observe(TransactionObserver::class);
    }
}
