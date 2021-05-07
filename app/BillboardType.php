<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class BillboardType extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $hidden = ['deleted_at'];

    protected $fillable = [
        'description'
    ];

    public static function listBillboardTypes()
    {
        return static::orderBy('id', 'DESC')->select('id', 'description')->get();
    }

    public function billboards()
    {
        return $this->hasMany(Billboard::class);
    }
}
