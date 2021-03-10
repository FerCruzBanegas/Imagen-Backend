<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImagesProduct extends Model
{
    protected $fillable = [
        'path', 'product_quotation_id'
    ];

    public function getUrlPathAttribute()
    {
        return public_path('img/quotations/') . $this->path;
    }

    public function product_quotation()
    {
        return $this->belongsTo(ProductQuotation::class, 'product_quotation_id');
    }
}
