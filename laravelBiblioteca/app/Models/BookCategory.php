<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookCategory extends Model
{
    //Datos introducidos por nosotros
    use HasFactory;
    protected $table = 'book_category';

    public function book()
    {
        return $this->belongsTo(Books::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
