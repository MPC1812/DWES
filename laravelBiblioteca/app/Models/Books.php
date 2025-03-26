<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Books extends Model
{
    //Datos introducidos por nosotros
    use HasFactory;

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function loan()
    {
        return $this->hasMany(Loan::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
