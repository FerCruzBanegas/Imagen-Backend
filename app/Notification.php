<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Notification extends Model
{
    protected $connection = 'mongodb';

    public function index()
    {
        return Notification::all();
    }
}
