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
        Schema::create('ujians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('santri_id')->constrained('santris')->onDelete('cascade');
            $table->foreignId('penguji_id')->constrained('pengujis')->onDelete('cascade');
            $table->foreignId('tempat_id')->constrained('tempats')->onDelete('cascade');
            $table->date('tanggal_ujian');
            $table->string('jumlah_ujian');
            $table->text('catatan');
            $table->double('nilai');
            $table->time('jam');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ujians');
    }
};
