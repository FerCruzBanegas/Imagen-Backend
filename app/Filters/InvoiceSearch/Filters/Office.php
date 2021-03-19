<?php

namespace App\Filters\InvoiceSearch\Filters;

use App\License;
use Illuminate\Database\Eloquent\Builder;
use App\Filters\Types\TypesFilter;
use App\Filters\Filter;

class Office implements Filter
{
    public static function apply(Builder $builder, Array $data)
    {
        // $license = License::where('office_id', $data['value'])->first();
        // $builder = $builder->where('license_id', $license->id);
        $builder = $builder->whereHas('license', function ($query) use ($data) {
            return $query->where('office_id', $data['value']);
        }); 

        $typeFilter = new TypesFilter();
        return $typeFilter->run($builder, $data);
    }
}