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
        Schema::create('razonamiento_nums', function (Blueprint $table) {
            $table->id();
            for ($i = 1; $i <= 10; $i++) {
                $table->integer("mrn_$i")->nullable(false);
            }
            // Añadir la columna applicant_id como string
            $table->string('applicant_id');
            // Crear la clave foránea para applicant_id
            $table->foreign('applicant_id')->references('id')->on('applicants')->onDelete('cascade');
            // Cambiar el tipo de 'remaining_time' a integer (para guardar en segundos)
            $table->string('current_step');
            $table->integer('remaining_time')->nullable(); 
            $table->json('selected_options')->nullable(); // Cambia a nullable() si es necesario
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('razonamiento_nums');
    }
};
