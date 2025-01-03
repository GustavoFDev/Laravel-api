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
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->string('name_a');
            $table->string('surname_p');
            $table->string('surname_m');
            $table->string('email_a');
            $table->string('street');
            $table->string('number');
            $table->string('col');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('postal_code');
            $table->string('day_phone');
            $table->string('night_phone');
            $table->date('b_date');
            $table->boolean('employee');
            $table->boolean('former_employee');
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};
