<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('halaqahs', function (Blueprint $table) {

            // hapus foreign key lama
            $table->dropForeign(['penyimak_id']);

            // buat ulang foreign key yang benar
            $table->foreign('penyimak_id')
                ->references('id')
                ->on('penyimaks')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('halaqahs', function (Blueprint $table) {

            $table->dropForeign(['penyimak_id']);
        });
    }
};