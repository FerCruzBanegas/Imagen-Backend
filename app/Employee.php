<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SecureDelete;

class Employee extends Model
{
	use SecureDelete, SoftDeletes;
    
    protected $dates = ['deleted_at'];

    protected $hidden = ['deleted_at'];

    protected $fillable = [
        'name', 'document', 'num_document', 'address', 'phone', 'email', 'office_id',
    ];

    protected $relationships = [
        'work_orders'
    ];

    public static function listEmployees()
    {
        return static::orderBy('id', 'DESC')->select('id', 'name')->get();
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    public function scopeDesc($query)
    {
        return $query->orderBy('id', 'DESC');
    }

    public function scopeIn($query, $employees)
    {
        return $query->whereIn('id', $employees);
    }

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function work_orders()
    {
        return $this->belongsToMany(WorkOrder::class);
    }
}
