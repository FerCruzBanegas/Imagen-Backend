<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SecureDelete;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, SecureDelete, SoftDeletes;

    protected $dates    = ['deleted_at'];
    
    protected $fillable = [
        'name', 'forename', 'surname', 'email', 'phone', 'password', 'state', 'office_id', 'profile_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $relationships = [
        'quotations'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function listUsers()
    {
        return static::orderBy('id', 'DESC')->select('id', 'name')->get();
    }

    public static function listSeller()
    {
        return static::orderBy('id', 'DESC')->select('id', 'name')->has('quotations')->get();
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function quotations()
    {
        return $this->hasMany(Quotation::class);
    }

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
