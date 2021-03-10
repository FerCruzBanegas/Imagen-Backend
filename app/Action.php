<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
	public $timestamps = false;

    protected $fillable = ['name', 'method', 'order', 'title'];

    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }

    public static function listActions()
    {
        return static::select('title', 'name', 'id')->get();
    }
}