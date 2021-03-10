<?php

namespace App\Filters\ProductSearch\Searches;

class ProductsFilter extends Filter
{
    protected $value;

    protected $filterKeys = [
        'name' => 'filterByName',
        'code' => 'filterByCode',
    ];

    protected $priceKeys = [
        'price_with_tax' => 'priceWithTax',
        'price_without_tax' => 'priceWithoutTax',
        'normal_price' => 'normalPrice',
        'volume_price' => 'volumePrice',
    ];

    protected function filterByName()
    {
        $this->builder = $this->builder->whereRaw("MATCH (name) AGAINST (? IN BOOLEAN MODE)" , fullTextWildcardsInitEnd($this->request->input('value')));
    }

    protected function filterByCode()
    {
        if (strpos($this->request->input('value'), '-')) {
            $this->value = str_replace("-", " ", $this->request->input('value'));
        } else {
            $this->value = $this->request->input('value');
        }

        $this->builder = $this->builder->whereRaw("MATCH (code) AGAINST (? IN BOOLEAN MODE)" , fullTextWildcardsInitEnd($this->value));
    }

    public function cost($office)
    {
        return $this->builder->join('costs as c', 'products.id', '=', 'c.product_id')
          ->where(function($query) use ($office) {
            $query->where('c.active', 1)
                  ->where('c.office_id', $office);
        });
    }

    protected function priceWithTax($office)
    {
        $this->builder = $this->cost($office)->select('products.id', 'products.name', 'products.material', 'products.quality', 'products.finish', 'c.price_with_tax AS price');
    }

    protected function priceWithoutTax($office)
    {
        $this->builder = $this->cost($office)->select('products.id', 'products.name', 'products.material', 'products.quality', 'products.finish', 'c.price_without_tax AS price');
    }

    protected function normalPrice($office)
    {
        $this->builder = $this->cost($office)->select('products.id', 'products.name', 'products.material', 'products.quality', 'products.finish', 'c.normal_price AS price');
    }

    protected function volumePrice($office)
    {
        $this->builder = $this->cost($office)->select('products.id', 'products.name', 'products.material', 'products.quality', 'products.finish', 'c.volume_price AS price');
    }
}