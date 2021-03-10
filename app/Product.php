<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SecureDelete;

class Product extends Model
{
    use SecureDelete, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $hidden = ['deleted_at'];

    protected $fillable = [
        'code', 'name', 'description', 'material', 'quality', 'finish', 'dimension', 'category_id',
    ];

    protected $relationships = [
        'costs', 'quotations'
    ];

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    public function scopeDesc($query)
    {
        return $query->orderBy('id', 'DESC');
    }

    public function scopeIn($query, $products)
    {
        return $query->whereIn('id', $products);
    }

    public function costs()
    {
        return $this->hasMany(Cost::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function quotations()
    {
        return $this->belongsToMany(Quotation::class)->withPivot('id', 'uuid', 'quantity', 'dimension', 'description', 'material', 'quality', 'finish', 'materialCheck', 'qualityCheck', 'finishCheck', 'price', 'subtotal', 'state', 'price_type', 'type', 'unit', 'cooldown');
    }

    public function invoices()
    {
        return $this->belongsToMany(Invoice::class)->withPivot('id', 'quantity', 'description', 'price', 'subtotal');
    }

    public function notes()
    {
        return $this->belongsToMany(Note::class)->withPivot('id', 'quantity', 'description', 'price', 'subtotal');
    }
}
