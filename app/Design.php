<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Design extends Model
{
    protected $fillable = [
        'filename', 
        'machine', 
        'quality', 
        'material', 
        'cutting_dimension', 
        'print_dimension', 
        'finished', 
        'test_print', 
        'quote_approved_date', 
        'design_approved_date', 
        'reference', 
        'path', 
        'support_path',
        'set_image_support',
        'note', 
        'product_quotation_id',
    ];

    public function getUrlPathAttribute()
    {
        return 'http://imagen-erp.test/img/quotations/' . $this->path;
    }

    public function getDesignApprovedDateAttribute($date)
    {
        return Carbon::parse($date)->format('d/m/Y');
    }

    public function quotation()
    {
        return $this->belongsTo(ProductQuotation::class, 'product_quotation_id');
    }

    public function machines()
    {
        return $this->belongsToMany(Machine::class);
    }
}
