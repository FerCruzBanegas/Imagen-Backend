<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Billboard extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $hidden = ['deleted_at'];

    protected $fillable = [
        'code', 'uuid', 'zone', 'location', 'dimension', 'price', 'illumination', 'state_id', 'latitude', 'longitude', 'photosphere', 'city_id', 'billboard_type_id'
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });
    }

    public function scopeDesc($query)
    {
        return $query->orderBy('id', 'DESC');
    }

    public function scopeIn($query, $customers)
    {
        return $query->whereIn('id', $customers);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function billboard_type()
    {
        return $this->belongsTo(BillboardType::class);
    }
}
