<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SecureDelete;

class Profile extends Model
{
    use SecureDelete, SoftDeletes;

    protected $dates    = ['deleted_at'];

    protected $fillable = ['description'];
    
    protected $appends  = ['action_list'];

    protected $relationships = [
        'users'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function actions()
    {
        return $this->belongsToMany(Action::class);
    }

    public function getActionListAttribute()
    {
        return $this->actions->pluck('id')->toArray();
    }

    public static function listProfiles()
    {
        return static::orderBy('id', 'DESC')->select('id', 'description')->get();
    }
}