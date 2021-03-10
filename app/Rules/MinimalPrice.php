<?php

namespace App\Rules;

use \App\Cost;
use Illuminate\Contracts\Validation\Rule;

class MinimalPrice implements Rule
{
    protected $attribute;
    protected $old_price;
    protected $new_price;

    protected function checkPrice($value): bool
    {
        return ($value['price_type'] == 'normal_price' || $value['price_type'] == 'volume_price');
    }

    public function passes($attribute, $value)
    {
        $this->attribute = $attribute;
        $this->new_price = $value['new_price'];

        // \Auth::user()->id === 1 || 
        if (\Auth::user()->id === 1 || $value['price_type'] == 'price_service') {
            return true;
        }

        if ($this->checkPrice($value)) {
            
            $value['price_type'] = 'price_with_tax';

            $cost = Cost::price($value);

            $this->old_price = $cost[$value['price_type']];

            return $value['new_price'] >= $this->old_price;

        } else {
            $cost = Cost::price($value);
            $this->old_price = $cost[$value['price_type']];
            return $value['new_price'] >= $cost[$value['price_type']];
        }
    }

    public function message()
    {
        $key = (int) filter_var($this->attribute, FILTER_SANITIZE_NUMBER_INT) + 1;
        return "El item {$key} no puede tener un precio menor a: {$this->old_price} (precio actual: $this->new_price)";
    }
}
