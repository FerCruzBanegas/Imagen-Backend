<?php

namespace App\Filters\EmployeeSearch\Searches;

class EmployeesFilter extends Filter
{
    protected $filterKeys = [
        'name' => 'filterByName',
    ];

    protected function filterByName()
    {
        $this->builder = $this->builder->whereRaw("MATCH (name) AGAINST (? IN BOOLEAN MODE)" , fullTextWildcardsInitEnd($this->request->input('value')));
    }
}