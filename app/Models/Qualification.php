<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    protected $fillable = ['name'];

    public function academics()
    {
        return $this->hasMany(Academic::class, 'qualification_id');
    }
}
