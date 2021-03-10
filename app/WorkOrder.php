<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
// use Illuminate\Database\Eloquent\Model;
use App\Models\MyBaseModel;
use Illuminate\Support\Facades\Cache;//AQUI

class WorkOrder extends MyBaseModel
{
	use SoftDeletes;
    
    protected $dates = ['deleted_at'];

    protected $hidden = ['deleted_at'];

    // protected $with = ['city', 'employee'];

    protected $fillable = [
        'number', 'opening_date', 'estimated_date', 'closing_date', 'type_work', 'note', 'name_staff', 'address_work', 'quotation_id', 'city_id'
    ];

    public function scopeDesc($query)
    {
        return $query->orderBy('id', 'DESC');
    }

    public function scopeIn($query, $workOrders)
    {
        return $query->whereIn('id', $workOrders);
    }

    public function scopeChecklist($query)
    {
        $user = auth()->user();
        $cache = Cache::get('actions_' . $user->id);
        return $query->when(in_array('*', $cache), function ($query) {
            return $query;
        })->when(!in_array('*', $cache), function($query) use ($user) {
            $query->whereHas('quotation', function ($query) use ($user) {
                return $query->where('office_id', $user->office->id);
            });
        });
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }

    public function employees()
    {
        return $this->belongsToMany(Employee::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
