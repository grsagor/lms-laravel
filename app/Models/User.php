<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements Authenticatable
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = substr(uniqid(), 0, 13).'-stlout-'.random_int(10000000000000000, 99999999999999999);
        });
    }

    protected $fillable = [
        'name', // Add 'name' to the fillable array
        'email',
        'password',
        'role', // Include 'role' if it's fillable
    ];

    public function getAuthIdentifierName()
    {
        return 'id'; // Change 'id' to your primary key field if it's different
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }
}
