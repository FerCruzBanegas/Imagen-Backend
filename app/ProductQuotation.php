<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductQuotation extends Pivot
{
    public $incrementing = true;

    public $timestamps = false;

    public function images()
    {
        return $this->hasMany(ImagesProduct::class, 'product_quotation_id');
    }

    public function design()
    {
        return $this->hasOne(Design::class, 'product_quotation_id');
    }
}
