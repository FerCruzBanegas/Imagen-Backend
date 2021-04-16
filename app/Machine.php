<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SecureDelete;

class Machine extends Model
{
    use SecureDelete, SoftDeletes;
    
    protected $dates = ['deleted_at'];

    protected $hidden = ['deleted_at'];

    protected $fillable = [
        'description',
    ];

    protected $relationships = [
        'designs'
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
