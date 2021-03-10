<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
	use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $hidden = ['deleted_at'];

    protected $fillable = [
        'tool', 'admin_expense', 'utility', 'tax', 'total_amount', 'price_without_tax', 'price_with_tax', 'normal_price', 'volume_price', 'active', 'product_id', 'office_id',
    ];

    public function syncWorkers(Array $worker_items)
    {
        $children = $this->workers;
        $worker_items = collect($worker_items);

        $deleted_ids = $children->filter(function ($child) use ($worker_items) {
            return empty($worker_items->where('id', $child->id)->first());
        })->map(function ($child) {
            $id = $child->id;
            $child->delete();
            return $id;
        });

        $updates = $worker_items->filter(function ($worker) {
            return isset($worker['id']);
        })->map(function ($worker) {
            $this->workers->map(function ($c) use ($worker) {
                $c->updateOrCreate([
                    'id' => $worker['id']
                ],[
                    'description' => $worker['description'],
                    'quantity' => $worker['quantity'],
                    'price' => $worker['price'],
                    'total' => $worker['total'],
                ]);
            });
        });

        $attachments = $worker_items->filter(function ($worker) {
            return ! isset($worker['id']);
        })->map(function ($worker) use ($deleted_ids) {
            $worker['id'] = $deleted_ids->pop();
            return $worker;
        })->toArray();

        $this->workers()->createMany($attachments);
    }

    public function scopePrice($query, $value)
    {
        return $query->where(function($query) use ($value) {
                $query->where('active', 1)
                      ->where('office_id', $value['office'])
                      ->where('product_id', $value['product']);
            })->select($value['price_type'])->first();
    }

    public function scopeDeactivated($query)
    {
        return $query->where('id', '<>', $this->id)->where('office_id', $this->office_id)->where('product_id', $this->product_id)->update(['active' => 0]);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function materials()
    {
        return $this->belongsToMany(Material::class)->withPivot('id', 'quantity', 'price', 'total');
    }

    public function workers()
    {
        return $this->hasMany(Worker::class);
    }
}
