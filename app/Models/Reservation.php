<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'learning_space_id', 'reservation_date', 'start_time', 'end_time', 'status', 'processed_by', 'reason', 'special_requests'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function learningSpace()
    {
        return $this->belongsTo(LearningSpace::class);
    }

    public function processedBy()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }
}
