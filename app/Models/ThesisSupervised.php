<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThesisSupervised extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title_of_research',
        'supervisor',
        'co_supervisor',
        'year_of_completion',
        'name_of_university',
        'name_of_student',
        'registration_number',
        'date_of_enrollment',
        'date_of_completion',
    ];
}
