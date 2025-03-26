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
        Schema::create('equipos', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo', ['PC', 'Portátil', 'Tablet', 'Móvil', 'Otro'])->default('pc');
            $table->string('marca');
            $table->string('modelo')->nullable();
            $table->enum('cargador', ['Si', 'No'])->nullable();
            $table->enum('bateria', ['Si', 'No'])->nullable();
            $table->text('comentarios')->nullable();
            $table->timestamps();
            // Cada equipo pertenece a un cliente, si se borra el cliente o se actualiza su id, se actualiza en cascada
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')
                ->on('clientes')->cascadeOnDelete()->cascadeOnUpdate();
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
