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
        Schema::table('penyimaks', function (Blueprint $table) {
            $table->string('tipe'); // eksternal / pengurus
            $table->string('nim')->nullable();
            $table->string('fakultas')->nullable();
            $table->string('jurusan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penyimaks', function (Blueprint $table) {
            //
        });
    }
};
