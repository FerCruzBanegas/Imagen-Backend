<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class City extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $hidden = ['deleted_at'];

    protected $fillable = [
        'name',
    ];

    public static function listCities()
    {
        return static::orderBy('id', 'DESC')->select('id', 'name')->get();
    }

    public function billboards()
    {
        return $this->hasMany(Billboard::class);
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    public function offices()
    {
        return $this->hasMany(Office::class);
    }

    public function work_orders()
    {
        return $this->hasMany(WorkOrder::class);
    }

    public static function pendingByCity()
    {
        return static::join('offices AS o', 'o.city_id', '=', 'cities.id')
            ->leftjoin('quotations AS q', function ($join) {
                $join->on('q.office_id', '=', 'o.id')
                    ->where('q.state_id', 1)
                    ->where('q.date', '>=', DB::raw("DATE_FORMAT(NOW() ,'%Y-01-01')"))
                    ->where('q.date', '<=', DB::raw("DATE_FORMAT(NOW(), '%Y-12-31')"));
            })
            ->select('name', DB::raw('COUNT(q.office_id) AS total'))
            ->groupBy('cities.name')
            ->get();
    }

    public static function approvedByCity()
    {
        return static::join('offices AS o', 'o.city_id', '=', 'cities.id')
            ->leftjoin('quotations AS q', function ($join) {
                $join->on('q.office_id', '=', 'o.id')
                    ->where('q.state_id', 2)
                    ->where('q.date', '>=', DB::raw("DATE_FORMAT(NOW() ,'%Y-01-01')"))
                    ->where('q.date', '<=', DB::raw("DATE_FORMAT(NOW(), '%Y-12-31')"));
            })
            ->select('name', DB::raw('COUNT(q.office_id) AS total'))
            ->groupBy('cities.name')
            ->get();
    }

    public static function executedByCity()
    {
        return static::join('offices AS o', 'o.city_id', '=', 'cities.id')
            ->leftjoin('quotations AS q', function ($join) {
                $join->on('q.office_id', '=', 'o.id')
                    ->where('q.state_id', 3)
                    ->where('q.date', '>=', DB::raw("DATE_FORMAT(NOW() ,'%Y-01-01')"))
                    ->where('q.date', '<=', DB::raw("DATE_FORMAT(NOW(), '%Y-12-31')"));
            })
            ->select('name', DB::raw('COUNT(q.office_id) AS total'))
            ->groupBy('cities.name')
            ->get();
    }

    public static function quotesPerMonth()
    {
        return static::join('offices AS o', 'o.city_id', '=', 'cities.id')
            ->leftjoin('quotations AS q', function ($join) {
                $join->on('q.office_id', '=', 'o.id')
                    ->where('q.date', '>=', DB::raw("DATE_FORMAT(NOW() ,'%Y-01-01')"))
                    ->where('q.date', '<=', DB::raw("DATE_FORMAT(NOW(), '%Y-12-31')"));
            })
            ->select('name', DB::raw('
                count(if(month(date) = 1, q.office_id, null))  AS Ene,
                count(if(month(date) = 2, q.office_id, null))  AS Feb,
                count(if(month(date) = 3, q.office_id, null))  AS Mar,
                count(if(month(date) = 4, q.office_id, null))  AS Abr,
                count(if(month(date) = 5, q.office_id, null))  AS May,
                count(if(month(date) = 6, q.office_id, null))  AS Jun,
                count(if(month(date) = 7, q.office_id, null))  AS Jul,
                count(if(month(date) = 8, q.office_id, null))  AS Ago,
                count(if(month(date) = 9, q.office_id, null))  AS Sep,
                count(if(month(date) = 10, q.office_id, null)) AS Oct,
                count(if(month(date) = 11, q.office_id, null)) AS Nov,
                count(if(month(date) = 12, q.office_id, null)) AS Dic'))
            ->groupBy('cities.name')
            ->get();
    }
}
