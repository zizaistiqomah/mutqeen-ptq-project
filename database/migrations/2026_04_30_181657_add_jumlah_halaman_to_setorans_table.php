<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('setorans', function (Blueprint $table) {

            $table->integer('jumlah_halaman')->default(0);

        });
    }

    public function down(): void
    {
        Schema::table('setorans', function (Blueprint $table) {

            $table->dropColumn('jumlah_halaman');

        });
    }
};