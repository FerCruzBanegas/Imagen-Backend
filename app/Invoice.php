<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;//AQUI

class Invoice extends Model
{
    protected $dates = ['deleted_at'];

    protected $hidden = ['deleted_at'];

    protected $fillable = [
        'date', 'number', 'control_code', 'total', 'nit_name', 'nit', 'title', 'footer', 'oc', 'hea', 'details', 'summary', 'cancelled', 'state_id', 'license_id', 'customer_id', 'user_id', 'quotation_id', 'closing_date'
    ];

    public function scopeDesc($query)
    {
        return $query->orderBy('id', 'DESC');
    }

    public function scopeIn($query, $invoices)
    {
        return $query->whereIn('id', $invoices);
    }

    public function scopeChecklist($query)
    {
        $user = auth()->user();
        $cache = Cache::get('actions_' . $user->id);
        if (in_array('invoices.all', $cache) || in_array('*', $cache)) {
            return $query;
        } else if (in_array('invoices.single', $cache)) {
            if ($user->profile->description === 'Ventas') {
                return $query->where('user_id', $user->id);
            } else {
                return $query->whereHas('license', function ($query) use ($user) {
                    return $query->where('office_id', $user->office->id);
                });             
            }
        }
    }

    public function payments()
    {
        return $this->morphMany(Payment::class, 'paymentable');
    }

    public function license()
    {
        return $this->belongsTo(License::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('id', 'quantity', 'description', 'price', 'subtotal');
    }
}
