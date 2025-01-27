<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() {
        Schema::table('creencias1s', function (Blueprint $table) {
            $table->integer('current_step')->default(1); // Asigna un valor predeterminado de 1
        });
    }
    
    public function down() {
        Schema::table('creencias1s', function (Blueprint $table) {
            $table->dropColumn('current_step');
        });
    }
    
};
