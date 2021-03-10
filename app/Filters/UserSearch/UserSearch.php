<?php

namespace App\Filters\UserSearch;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use App\Filters\Search;

class UserSearch extends Search
{
	public static function checkSortFilter(Request $request, Builder $query)
    {
        if ($request->filled('sort')) {
            $sort = $request->input('sort');
            return $query->with(['quotations' => function ($query) {
                    $query->where('state_id', 1);
                }])->orderBy($sort[0]['field'], $sort[0]['dir']);
              
        } else {
            return $query->with(['quotations' => function ($query) {
                    $query->where('state_id', 1);
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