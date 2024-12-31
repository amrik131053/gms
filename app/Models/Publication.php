<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'first_author',
        'co_authors',
        'title_of_research_paper',
        'name_of_journal',
        'volume_no',
        'issue_no',
        'page_no',
        'year',
        'impact_factor',
        'national_international',
        'source_of_authorization',
    ];
}
