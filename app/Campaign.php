<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $hidden = ['deleted_at'];

    protected $fillable = [
        'name', 'date_start', 'date_end', 'note', 'rental_id',
    ];

    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }
}
