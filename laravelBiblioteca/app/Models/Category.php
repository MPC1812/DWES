<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //Datos introducidos por nosotros
    use HasFactory;

    public function books()
    {
        return $this->belongsToMany(Books::class);
    }
}
