<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $hidden = ['deleted_at'];

    protected $fillable = [
        'description', 'address', 'phone_one', 'phone_two', 'email', 'city_id'
    ];

    public static function listOffices()
    {
        return static::orderBy('id', 'DESC')->select('id', 'description', 'address')->get();
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function costs()
    {
        return $this->hasMany(Cost::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function warehouses()
    {
        return $this->hasMany(Warehouse::class);
    }

    public function quotations()
    {
        return $this->hasMany(Quotation::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function licenses()
    {
        return $this->hasMany(License::class);
    }
    
    public function vouchers()
    {
        return $this->hasMany(Voucher::class);
    }
}
