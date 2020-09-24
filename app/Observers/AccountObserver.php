<?php

namespace App\Observers;

use App\Account;

class AccountObserver
{
    /**
     * Handle the account "created" event.
     *
     * @param  \App\Account  $account
     * @return void
     */
    public function created(Account $account)
    {
        // Handling system cache
        // Handling Notifications
        // Handling Logging
    }

    /**
     * Handle the account "updated" event.
     *
     * @param  \App\Account  $account
     * @return void
     */
    public function updated(Account $account)
    {
        // Handling system cache
        // Handling Notifications
        // Handling Logging
    }

    /**
     * Handle the account "deleted" event.
     *
     * @param  \App\Account  $account
     * @return void
     */
    public function deleted(Account $account)
    {
        // Handling system cache
        // Handling Notifications
        // Handling Logging
    }

    /**
     * Handle the account "restored" event.
     *
     * @param  \App\Account  $account
     * @return void
     */
    public function restored(Account $account)
    {
        // Handling system cache
        // Handling Notifications
        // Handling Logging
    }

    /**
     * Handle the account "force deleted" event.
     *
     * @param  \App\Account  $account
     * @return void
     */
    public function forceDeleted(Account $account)
    {
        // Handling system cache
        // Handling Notifications
        // Handling Logging
    }
}
