<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'birth_year',
        'is_alive',
        'nationality',
        'capital'
    ];

    // public function books()
    // {
    //     return $this->hasMany(Gutiar::class);
    // }

}
