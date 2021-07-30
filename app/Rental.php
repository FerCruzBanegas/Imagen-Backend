<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $hidden = ['deleted_at'];

    protected $fillable = [
        'date_start', 'date_end', 'observation', 'illumination', 'print', 'amount_monthly', 'amount_total', 'condition_id', 'state', 'customer_id', 'billboard_id', 'user_id', 'rental_id', 'quotation_id',
    ];

    public function scopeDesc($query)
    {
        return $query->orderBy('id', 'DESC');
    }

    public function scopeIn($query, $customers)
    {
        return $query->whereIn('id', $customers);
    }

    public function scopeRenovations($query, $rental, $sort)
    {
        return $query->where('rental_id', $rental)->orderBy('created_at', $sort);
    }

    public function children()
    {
        return $this->hasMany(Rental::class, 'rental_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function billboard()
    {
        return $this->belongsTo(Billboard::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }

    public function pritings()
    {
        return $this->hasMany(Priting::class);
    }

    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }
}
