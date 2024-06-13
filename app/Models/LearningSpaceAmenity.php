<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningSpaceAmenity extends Model
{
    use HasFactory;

    public $table = 'learning_space_amenities';

    public function amenities() {
        return $this->belongsTo(Amenity::class, 'amenity_id');
    }
}
