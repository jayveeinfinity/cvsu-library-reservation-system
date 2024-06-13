<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    use HasFactory;

    public $fillable = ['name', 'icon'];

    public function learningSpaces()
    {
        return $this->belongsToMany(LearningSpace::class, 'learning_space_amenities', 'amenity_id', 'learning_space_id');
    }
}
