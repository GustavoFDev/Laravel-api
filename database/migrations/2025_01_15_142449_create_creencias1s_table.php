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
        Schema::create('creencias1s', function (Blueprint $table) {
            $table->id();
            
            // Crear las columnas mcp1_1 hasta mcp1_48
            for ($i = 1; $i <= 48; $i++) {
                $table->integer("mcp1_$i")->nullable(false);
            }

            // Cambiar el tipo de 'remaining_time' a integer (para guardar en segundos)
            $table->integer('remaining_time')->nullable(); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('creencias1s');
    }
};
