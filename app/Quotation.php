<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;//AQUI

class Quotation extends Model
{
	use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $hidden = ['deleted_at'];

    protected $fillable = [
        'cite', 'attends', 'attends_phone', 'installment', 'date', 'amount', 'discount', 'term', 'payment', 'validity', 'note', 'condition', 'state_id', 'customer_id', 'user_id', 'office_id'
    ];

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    public function scopeChecklist($query)
    {
        $user = auth()->user();
        $cache = Cache::get('actions_' . $user->id);
        if (in_array('quotations.all', $cache) || in_array('*', $cache)) {
            return $query;
        } else if (in_array('quotations.single', $cache)) {
            if ($user->profile->description === 'Ventas') {
                return $query->where('user_id', $user->id);
            } else {
                return $query->where('office_id', $user->office->id);                
            }
        }
    }

    public function scopeRelations($query)
    {
        return $query->with('state', 'user', 'customer');
    }

    public function scopePending($query)
    {
        return $query->where('state_id', 1);
    }
    
    public function scopeApproved($query)
    {
        return $query->where('state_id', 2);
    }

    public function scopeExecuted($query)
    {
        return $query->where('state_id', 3);
    }

    public function scopeStatus($query, $quotation)
    {
        return $query->where('id', $quotation)->first('state_id');
    }

    public function scopeDesc($query)
    {
        return $query->orderBy('id', 'DESC');
    }

    public function scopeIn($query, $quotations)
    {
        return $query->whereIn('id', $quotations);
    }

    public function scopeReceivable($query)
    {
        return $query->where(function($query) {
            $query->where('condition', '!=', 1)
                  ->where('cancelled', 0);
        });
    }

    public function scopeCanceled($query)
    {
        return $query->where(function($query) {
            $query->where('condition', '!=', 1)
                  ->where('cancelled', 1);
        });
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function work_order()
    {
        return $this->hasOne(WorkOrder::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function receipt()
    {
        return $this->hasOne(Note::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->using('App\ProductQuotation')->withPivot('id', 'uuid', 'quantity', 'dimension', 'description', 'material', 'quality', 'finish', 'materialCheck', 'qualityCheck', 'finishCheck', 'price', 'subtotal', 'state', 'price_type', 'type', 'unit', 'cooldown');
    }
}
