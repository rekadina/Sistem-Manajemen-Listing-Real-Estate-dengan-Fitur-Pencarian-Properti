<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    // Pastikan semua nama kolom tabel ada disini
    protected $fillable = [
        'user_id', 'category_id', 'title', 'slug', 'description', 'price',
        'listing_type', 'status', 'negotiable',
        'province', 'city', 'district', 'address', 'latitude', 'longitude',
        'land_size', 'building_size', 'bedrooms', 'bathrooms', 'floors', 
        'garages', 'certificate', 'electricity',
        'images', 'facilities', 'video_url',
        'featured', 'views', 'agent_id', 
        'meta_title', 'meta_description'
    ];

    protected $casts = [
        'images' => 'array',
        'facilities' => 'array',
        'featured' => 'boolean',
        'negotiable' => 'boolean',
    ];

    // Relationship dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship dengan Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}