<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Machine extends Model
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];

    protected $hidden = ['deleted_at'];

    protected $fillable = [
        'description',
    ];

    public static function listMachines()
    {
        return static::orderBy('id', 'DESC')->select('id', 'description')->get();
    }

    public function designs()
    {
        return $this->belongsToMany(Design::class);
    }
}
