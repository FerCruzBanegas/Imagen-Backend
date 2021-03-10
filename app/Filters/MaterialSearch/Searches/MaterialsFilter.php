<?php

namespace App\Filters\MaterialSearch\Searches;

class MaterialsFilter extends Filter
{
    protected $filterKeys = [
        'name' => 'filterByName',
    ];

    protected function filterByName()
    {
        $this->builder = $this->builder->whereRaw("MATCH (name) AGAINST (? IN BOOLEAN MODE)" , fullTextWildcardsInitEnd($this->request->input('value')));
    }
}