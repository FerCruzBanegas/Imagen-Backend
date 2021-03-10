<?php
namespace App\Filters\ProductSearch\Searches;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class Filter
{
    protected $request;

    protected $builder;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        $method = $this->filterKeys[$this->request->input('column')];

        $this->{$method}();
        //cambio para analizar
        if ($this->request->filled('price_type')) {
            $price = $this->priceKeys[$this->request->input('price_type')];
            $this->{$price}($this->request->input('office'));
        }

        return $this->builder;
    }
}