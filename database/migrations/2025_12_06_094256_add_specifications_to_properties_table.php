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
        // Hanya tambah kolom yang BELUM ada
        if (!Schema::hasColumn('properties', 'building_size')) {
            $table->integer('building_size')->nullable();
        }
        if (!Schema::hasColumn('properties', 'floors')) {
            $table->integer('floors')->nullable();
        }
        if (!Schema::hasColumn('properties', 'garages')) {
            $table->integer('garages')->nullable();
        }
        if (!Schema::hasColumn('properties', 'electricity')) {
            $table->integer('electricity')->nullable();
        }
    });
}

    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('properties', function (Blueprint $table) {
        $table->dropColumn(['bedrooms', 'bathrooms', 'land_size', 'building_size']);
    });
}
};
