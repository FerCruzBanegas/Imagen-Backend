<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SecureDelete;

class Task extends Model
{
	use SecureDelete, SoftDeletes;
    
    protected $dates = ['deleted_at'];

    protected $hidden = ['deleted_at'];

    protected $fillable = [
        'description', 'priority','completed', 'date_init', 'date_end', 'work_order_id', 'employee_id',
    ];

    // protected $relationships = [
    //     'work_orders'
    // ];

    public function work_order()
    {
        return $this->belongsTo(WorkOrder::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
