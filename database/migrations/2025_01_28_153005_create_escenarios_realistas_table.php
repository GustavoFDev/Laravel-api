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
        Schema::create('escenarios_realistas', function (Blueprint $table) {
            $table->id();
            for ($i = 1; $i <= 80; $i++) {
                $table->integer("er_$i")->nullable(false);
            }
            // Añadir la columna applicant_id como string
            $table->string('applicant_id');
            // Crear la clave foránea para applicant_id
            $table->foreign('applicant_id')->references('id')->on('applicants')->onDelete('cascade');
            // Cambiar el tipo de 'remaining_time' a integer (para guardar en segundos)
            $table->string('current_step');
            $table->integer('remaining_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('escenarios_realistas');
    }
};
