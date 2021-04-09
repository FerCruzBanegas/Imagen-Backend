<?php

namespace App\Filters\MachineSearch\Searches;

class MachinesFilter extends Filter
{
    protected $filterKeys = [
        'description' => 'filterByDescription',
    ];

    protected function filterByDescription()
    {
        $this->builder = $this->builder->whereRaw("MATCH (description) AGAINST (? IN BOOLEAN MODE)" , fullTextWildcardsInitEnd($this->request->input('value')));
    }
}