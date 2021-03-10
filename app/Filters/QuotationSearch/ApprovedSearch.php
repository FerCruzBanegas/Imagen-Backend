<?php

namespace App\Filters\QuotationSearch;

use App\Quotation;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use App\Filters\Search;

class ApprovedSearch extends Search
{
	public static function checkSortFilter(Request $request, Builder $query)
    {
        if ($request->filled('sort')) {
            $sort = $request->input('sort');
            return $query->approved()->orderBy($sort[0]['field'], $sort[0]['dir'])->checklist()->relations();
              
        } else {
            return $query->approved()->orderBy('id', 'DESC')->checklist()->relations();
        }
    }
    
    protected static function createFilterDecorator($name)
    {
        return __NAMESPACE__ . '\\Filters\\' . Str::studly($name);
    }

    protected static function getResults(Builder $query, $request)
    {
        return $query->approved()->orderBy('id', 'DESC')->checklist()->relations()->paginate($request->take);
    }
}