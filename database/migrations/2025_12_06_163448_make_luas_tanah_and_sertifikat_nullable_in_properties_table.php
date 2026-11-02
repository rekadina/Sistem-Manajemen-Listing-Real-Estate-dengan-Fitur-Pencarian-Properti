<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::table('properties', function (Blueprint $table) {
        // 1. Ubah 'land_size' menjadi nullable
        $table->integer('land_size')->nullable()->change(); 
        
        // 2. Ubah 'certificate' menjadi nullable
        $table->string('certificate')->nullable()->change(); 
    });
}

public function down(): void
{
    Schema::table('properties', function (Blueprint $table) {
        // Kembalikan ke kondisi wajib isi (tidak nullable)
        $table->integer('land_size')->nullable(false)->change(); 
        $table->string('certificate')->nullable(false)->change();
    });
}
};
