<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Loan extends Model
{
    //Datos añadidos por nosotros
    use HasFactory;

    protected $table = 'loans';

    public function book()
    {
        return $this->belongsTo(Books::class);
    }
}
