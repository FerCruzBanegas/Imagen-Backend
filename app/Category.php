<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public static function listCategories()
    {
        return static::orderBy('id', 'DESC')->select('id', 'name')->get();
    }
}
