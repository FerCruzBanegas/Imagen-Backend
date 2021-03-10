<?php

namespace App\Filters\InvoiceSearch\Filters;

use App\Invoice;
use Illuminate\Database\Eloquent\Builder;
use App\Filters\Types\TypesFilter;
use App\Filters\Filter;

class Date implements Filter
{
    public static function apply(Builder $builder, Array $data)
    {
        $builder = $builder->where(function($query) use ($data) {
            $query->where('invoices.date', '>=', $data['value']['initial_date'])
                  ->where('invoices.date', '<=', $data['value']['final_date']);
            });
        
        $typeFilter = new TypesFilter();
        return $typeFilter->run($builder, $data);
    }
}