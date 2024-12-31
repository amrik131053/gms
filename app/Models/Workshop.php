<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'workshop_type',
        'theme_topic',
        'workshop_level',
        'participation_type',
        'organizing_institute',
        'organizing_secretary',
        'joint_secretary',
        'start_date',
        'validity_date',
        'days_attended',
        'sponsoring_body',
    ];
}
