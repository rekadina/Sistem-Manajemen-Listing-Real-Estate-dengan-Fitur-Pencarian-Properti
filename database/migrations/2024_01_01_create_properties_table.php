<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke user dan kategori
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            
            $table->string('title');
            $table->string('slug')->unique(); // Slug wajib ada
            
            $table->enum('listing_type', ['sale', 'rent'])->default('sale');
            $table->enum('status', ['active', 'sold', 'rented'])->default('active');
            $table->decimal('price', 15, 2);
            $table->text('description');

            // Lokasi
            $table->text('address');
            $table->string('city');
            $table->string('province');
            $table->string('district');

            // Spesifikasi
            $table->integer('bedrooms');
            $table->integer('bathrooms');
            $table->integer('land_size');
            $table->integer('building_size');
            $table->integer('floors')->default(1);
            $table->integer('garages')->default(0);
            $table->string('electricity')->nullable();
            $table->string('certificate')->nullable();

            $table->boolean('featured')->default(false);
            $table->boolean('negotiable')->default(false);
            
            $table->json('images')->nullable();
            $table->json('facilities')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};