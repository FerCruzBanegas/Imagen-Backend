<?php

namespace App\Filters\NoteSearch;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use App\Filters\SearchMorph;

class NoteAccountSearch extends SearchMorph
{
	public static function checkSortFilter(Request $request, Builder $query)
    {
        if ($request->filled('sort')) {
            $sort = $request->input('sort');
            return $query->where('cancelled', 0)->orderBy($sort[0]['field'], $sort[0]['dir'])->checklist();
        } else {
            return $query->where('cancelled', 0)->orderBy('id', 'DESC')->checklist();
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