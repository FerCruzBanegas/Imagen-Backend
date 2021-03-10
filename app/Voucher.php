<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
	public function scopeNumber($query, $office)
    {
        return $query->where(function($query) use ($office) {
		            $query->where('office_id', $office);
		        })->first();
    }

	public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}