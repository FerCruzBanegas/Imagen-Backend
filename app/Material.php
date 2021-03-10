<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SecureDelete;

class Material extends Model
{
	use SecureDelete, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $hidden = ['deleted_at'];

    protected $fillable = [
        'name', 'unity', 'description',
    ];

    protected $relationships = [
        'costs'
    ];

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
    
    public function costs()
    {
        return $this->belongsToMany(Cost::class)->withPivot('id', 'quantity', 'price', 'total');
    }
}
