<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;//AQUI

class Note extends Model
{
    protected $dates = ['deleted_at'];

    protected $hidden = ['deleted_at'];

    protected $fillable = [
        'number', 'date', 'total', 'discount', 'nit', 'cancelled', 'voucher_id', 'customer_id', 'user_id', 'quotation_id', 'closing_date' 
    ];

    public function scopeDesc($query)
    {
        return $query->orderBy('id', 'DESC');
    }

    public function scopeIn($query, $notes)
    {
        return $query->whereIn('id', $notes);
    }

    public function scopeChecklist($query)
    {
        $user = auth()->user();
        $cache = Cache::get('actions_' . $user->id);
        if (in_array('notes.all', $cache) || in_array('*', $cache)) {
            return $query;
        } else if (in_array('notes.single', $cache)) {
            if ($user->profile->id === 7) {
                return $query->where('user_id', $user->id);
            } else {
                return $query->whereHas('voucher', function ($query) use ($user) {
                    return $query->where('office_id', $user->office->id);
                });             
            }
        }
    }

    public function payments()
    {
        return $this->morphMany(Payment::class, 'paymentable');
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
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