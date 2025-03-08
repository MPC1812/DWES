<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MascotaMPC extends Model
{
    use HasFactory;

    protected $table = 'mascotas';

    protected $fillable = [
        'nombre',
        'descripcion',
        'tipo',
        'publica',
        'megusta',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
