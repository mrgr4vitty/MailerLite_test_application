<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = []; // All attributes are mass assignable

    // Get user of this account
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // Transactions
    public function fromTransactions()
    {
        return $this->hasMany('App\Transaction', 'from_id', 'id');
    }
    public function toTransactions()
    {
        return $this->hasMany('App\Transaction', 'to2_id', 'id');
    }
}
