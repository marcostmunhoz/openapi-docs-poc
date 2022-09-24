<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class Company extends Authenticatable implements JWTSubject
{
    use HasFactory;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'address',
        'email',
    ];

    /**
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    public function password(): Attribute
    {
        return new Attribute(set: fn (string $value) => bcrypt($value));
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
