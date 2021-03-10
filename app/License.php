<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class License extends Model
{
	public function scopeDosage($query, $office)
    {
        // return $query->where(function($query) use ($office) {
		//             $query->where('office_id', $office)
		//                   ->where('status_date', 1);
		//         })->first();
        return $query->latest()->where('office_id', $office)->first();
    }

	public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
