<?php

namespace App\Filters\InvoiceSearch;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use App\Filters\SearchMorph;

class InvoiceAccountSearch extends SearchMorph
{
	public static function checkSortFilter(Request $request, Builder $query)
    {
        if ($request->filled('sort')) {
            $sort = $request->input('sort');
            return $query->where('cancelled', 0)->where('state_id', 1)->orderBy($sort[0]['field'], $sort[0]['dir'])->checklist();
              
        } else {
            return $query->where('cancelled', 0)->where('state_id', 1)->orderBy('id', 'DESC')->checklist();
        }
    }
    
    protected static function createFilterDecorator($name)
    {
        return __NAMESPACE__ . '\\Filters\\' . Str::studly($name);
    }

    protected static function getResults(Builder $query, Request $request)
    {
        return $query->get();
    }
}