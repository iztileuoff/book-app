<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'author',
        'count',
        'gener_id'
    ];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function gener()
    {
        return $this->belongsTo(Gener::class);
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
}
