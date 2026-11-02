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
    Schema::table('inquiries', function (Blueprint $table) {
        // Cek dulu: Kalau kolom phone BELUM ada, baru buat
        if (!Schema::hasColumn('inquiries', 'phone')) {
            $table->string('phone')->nullable()->after('email');
        }

        // Cek dulu: Kalau kolom subject BELUM ada, baru buat
        if (!Schema::hasColumn('inquiries', 'subject')) {
            $table->string('subject')->nullable()->after('phone');
        }
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inquiries', function (Blueprint $table) {
            //
        });
    }
};
