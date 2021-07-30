<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Printing extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $hidden = ['deleted_at'];

    protected $fillable = [
        'meter_price', 'amount', 'campaign_id', 'rental_id',
    ];

    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
