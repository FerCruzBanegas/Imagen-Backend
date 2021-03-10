<?php

namespace App\Filters\NoteSearch\Filters;

use App\Voucher;
use Illuminate\Database\Eloquent\Builder;
use App\Filters\Types\TypesFilter;
use App\Filters\Filter;

class Office implements Filter
{
    public static function apply(Builder $builder, Array $data)
    {
        $voucher = Voucher::where('office_id', $data['value'])->first();
        $builder = $builder->where('voucher_id', $voucher->id);
        
        $typeFilter = new TypesFilter();
        return $typeFilter->run($builder, $data);
    }
}