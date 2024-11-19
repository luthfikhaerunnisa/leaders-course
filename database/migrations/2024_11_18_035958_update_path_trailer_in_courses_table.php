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
        Schema::table('courses', function (Blueprint $table) {
            $table->string('path_trailer')->nullable(false)->change(); // Pastikan kolom ini tidak boleh null atau kosong
        });
    }

    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->string('path_trailer')->nullable()->change(); // Jika ingin memungkinkan nilai null
        });
    }
};
