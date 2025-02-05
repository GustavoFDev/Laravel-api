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
        Schema::create('razonamiento_logs', function (Blueprint $table) {
            $table->id();
            for ($i = 1; $i <= 15; $i++) {
                $table->integer("mrl_$i")->nullable(false);
            }
            $table->string('applicant_id');
            $table->foreign('applicant_id')->references('id')->on('applicants')->onDelete('cascade');
            $table->integer('remaining_time')->nullable(); 
            $table->string('current_step'); 
            $table->timestamps();
        });
    } 

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('razonamiento_logs');
    }
};
