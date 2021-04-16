<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    // use SoftDeletes;

    // protected $dates = ['deleted_at'];

    // protected $hidden = ['deleted_at'];

    protected $fillable = [
        'date', 'type', 'op', 'number', 'path', 'amount',
    ];

    public function paymentable()
    {
        return $this->morphTo();
    }
}
