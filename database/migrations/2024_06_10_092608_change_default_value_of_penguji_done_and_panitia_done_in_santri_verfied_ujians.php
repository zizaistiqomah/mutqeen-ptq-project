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
        Schema::table('santri_verified_ujians', function (Blueprint $table) {
            $table->boolean('penguji_done')->nullable()->default(null)->change();
            $table->boolean('panitia_done')->nullable()->default(null)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('santri_verified_ujians', function (Blueprint $table) {
            //
        });
    }
};
