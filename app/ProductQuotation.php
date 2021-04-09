<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductQuotation extends Pivot
{
    public $incrementing = true;

    public $timestamps = false;

    // protected $primaryKey = 'uuid';

    public function images()
    {
        return $this->hasMany(ImagesProduct::class, 'product_quotation_id');
    }

    public function design()
    {
        return $this->hasOne(Design::class, 'product_quotation_id');
    }

    public function quote()
    {
        return $this->belongsTo(Quotation::class, 'quotation_id');
    }
}
