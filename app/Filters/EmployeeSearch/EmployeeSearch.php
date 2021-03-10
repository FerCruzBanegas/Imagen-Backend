<?php

namespace App\Filters\EmployeeSearch;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use App\Filters\Search;

class EmployeeSearch extends Search
{
	public static function checkSortFilter(Request $request, Builder $query)
    {
        if ($request->filled('sort')) {
            $sort = $request->input('sort');
            return $query->with(['work_orders' => function ($query) {
                    $query->whereNull('closing_date');
                }])->orderBy($sort[0]['field'], $sort[0]['dir']);
              
        } else {
            return $query->with(['work_orders' => function ($query) {
                    $query->whereNull('closing_date');
                }])->orderBy('id', 'DESC');
        }
    }
    
    protected static function createFilterDecorator($name)
    {
        return __NAMESPACE__ . '\\Filters\\' . Str::studly($name);
    }

    protected static function getResults(Builder $query, Request $request)
    {
        return $query->paginate($request->take);
    }
}