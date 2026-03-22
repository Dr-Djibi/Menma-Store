<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'nom', 'prix', 'stock', 'description', 
        'image_url', 'image_url2', 'image_url3', 'image_url4', 'image_url5', 
        'video_url'
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
