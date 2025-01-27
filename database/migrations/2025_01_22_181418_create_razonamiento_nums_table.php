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
            $table->string('razonamientonum_id');

            $table->foreign('razonamientonum_id')->references('id')->on('razonamientonums')->onDelete('cascade');

           $table->integer('remaining_time')->nullable(); 
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
