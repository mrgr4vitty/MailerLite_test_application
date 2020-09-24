<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = []; // All attributes are mass assignable

    public function from()
    {
        return $this->belongsTo('App\Account', 'from_id', 'id');
    }
    public function to()
    {
        return $this->belongsTo('App\Account', 'to_id', 'id');
    }
}
