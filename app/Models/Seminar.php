<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seminar extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'seminar_type',
        'theme_topic',
        'seminar_level',
        'participation_type',
        'seminar_date',
        'organizing_institute',
    ];
}
