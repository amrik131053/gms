<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormStep extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'form_data', 'current_step'];

    protected $casts = [
        'form_data' => 'array', // Ensure the form_data JSON is cast to an array
    ];
}
