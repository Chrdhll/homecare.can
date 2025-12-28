<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'slug',
        'gallery',
        'icon_class',
        'benefits',
        'image',
    ];

    protected $casts = [
        'gallery' => 'array', 
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    public function promotions()
    {
        return $this->hasMany(Promotion::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
