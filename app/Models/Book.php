<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'first_author',
        'co_authors',
        'title_of_book',
        'publisher',
        'issn_isbn_no',
        'type_of_book',
    ];
    
}
