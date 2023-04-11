<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function favourites()
    {
        return $this->hasMany(Favourite::class);
    }

    public function baskets()
    {
        return $this->hasMany(Basket::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function role()
    {
        if($this->id == 1){
            return 'admin';
        } else {
            return 'user';
        }
    }
}
