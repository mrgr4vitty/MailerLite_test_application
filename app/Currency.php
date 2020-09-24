<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{
    /**
     * System supports transactions with different currencies but it only has One Main Currency.
     * So if a user wants to transfer 10EUR (which is not main currency) this amount will be exchanged
     * to USD (which is main currency) and then it will be transfered. the main currency will be set in
     * table of Currencies in database. the exchange rate in this small project is a fixed ratio but we
     * can use libraries like SWAP to extract real-time exchange rates.
     * 
     * Note: This is my perception of currencies in this project!
     */

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = []; // All attributes are mass assignable
}
