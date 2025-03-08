<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //Datos añadidos por nosotros
        Schema::table('mascotas', function (Blueprint $table) {
            $table->string('nombre',50);
            $table->string('descripcion',250);
            $table->enum('tipo',['Perro', 'Gato', 'Pájaro','Dragón','Conejo','Hamster','Tortuga','Pez','Serpiente']);
            $table->enum('publica',['Si','No']);
            $table->bigInteger('megusta')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
