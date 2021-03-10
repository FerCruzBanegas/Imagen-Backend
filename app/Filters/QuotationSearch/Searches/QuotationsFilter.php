<?php

namespace App\Filters\QuotationSearch\Searches;

class QuotationsFilter extends Filter
{
    protected $value;

    protected $filterKeys = [
        'cite' => 'filterByCite',
    ];

    protected function filterByCite()
    {
        if (strpos($this->request->input('value'), '-')) {
            $this->value = str_replace("-", " ", $this->request->input('value'));
        } else {
            $this->value = $this->request->input('value');
        }

        $this->builder = $this->builder->whereRaw("MATCH (cite) AGAINST (? IN BOOLEAN MODE)" , fullTextWildcardsInitEnd($this->value));
    }
}