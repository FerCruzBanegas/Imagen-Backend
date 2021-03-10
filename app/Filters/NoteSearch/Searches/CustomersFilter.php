<?php

namespace App\Filters\NoteSearch\Searches;

class CustomersFilter extends Filter
{
    protected $filterKeys = [
        'business_name' => 'filterByBusinessName',
        // 'contact' => 'filterByContact',
        'nit' => 'filterByNit',
    ];

    protected function filterByBusinessName()
    {
        $this->builder = $this->builder->whereRaw("MATCH (business_name) AGAINST (? IN BOOLEAN MODE)" , fullTextWildcardsInitEnd($this->request->input('value')));
    }

    // protected function filterByContact()
    // {
    //     $this->builder = $this->builder->whereRaw("MATCH (contact) AGAINST (? IN BOOLEAN MODE)" , fullTextWildcardsInitEnd($this->request->input('value')));
    // }

    protected function filterByNit()
    {
        $this->builder = $this->builder->whereRaw("MATCH (nit) AGAINST (? IN BOOLEAN MODE)" , fullTextWildcardsInitEnd($this->request->input('value')));
    }
}