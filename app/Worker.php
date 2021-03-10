<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
	public $timestamps = false;
	
	protected $fillable = [
        'description', 'quantity', 'price', 'total', 'cost_id'
    ];

    public function cost()
    {
        return $this->belongsTo(Cost::class);
    }
}
