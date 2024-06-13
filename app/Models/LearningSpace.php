<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningSpace extends Model
{
    use HasFactory;

    public $fillable = ['cover_image_id'];
    
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function coverImage()
    {
        return $this->belongsTo(Image::class, 'cover_image_id');
    }
    
    public function images()
    {
        return $this->hasMany(Image::class, 'learning_space_id', 'id');
    }

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class, 'learning_space_amenities', 'learning_space_id', 'amenity_id');
    }
}
