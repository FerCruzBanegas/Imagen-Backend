<?php

namespace App\Filters\BillboardSearch\Searches;

class BillboardsFilter extends Filter
{
    protected $filterKeys = [
        'code' => 'filterByCode',
    ];

    protected function filterByCode()
    {
        $this->builder = $this->builder->whereRaw("MATCH (code) AGAINST (? IN BOOLEAN MODE)" , fullTextWildcardsInitEnd($this->request->input('value')));
    }
}