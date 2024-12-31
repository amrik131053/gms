<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academic extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'qualification',
        'course',
        'subjects',
        'mode',
        'school_clg',
        'uni_board',
        'passing_date',
        'marks_obtained',
        'total_marks',
        'cgpa',
        'percent',
    ];
    public function qualification()
    {
        return $this->belongsTo(Qualification::class, 'qualification_id');
    }
}
