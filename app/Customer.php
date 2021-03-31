<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SecureDelete;

class Customer extends Model
{
    use SecureDelete, SoftDeletes;
    
    protected $dates = ['deleted_at'];

    protected $hidden = ['deleted_at'];

    protected $fillable = [
        'business_name', 'address', 'nit', 'phone', 'email', 'city_id',
    ];

    protected $relationships = [
        'quotations'
    ];

    public static function listCustomers()
    {
        return static::orderBy('id', 'DESC')->select('id', 'business_name')->get();
    }

    public function scopeDesc($query)
    {
        return $query->orderBy('id', 'DESC');
    }

    public function scopeIn($query, $customers)
    {
        return $query->whereIn('id', $customers);
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function quotations()
    {
        return $this->hasMany(Quotation::class)->orderBy('id', 'DESC');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
