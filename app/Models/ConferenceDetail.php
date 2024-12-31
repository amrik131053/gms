<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConferenceDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'conference_type',
        'national_international',
        'participation_type',
        'organizing_institute',
        'organising_secretary',
        'joint_secretary',
        'start_date_of_conference',
        'date_of_validity',
        'no_of_days_attended',
    ];
    
}
