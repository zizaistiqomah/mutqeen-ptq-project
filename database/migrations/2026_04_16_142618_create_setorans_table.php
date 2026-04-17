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
        Schema::create('setorans', function (Blueprint $table) {
            $table->id();

            // santri
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // penyimak (yang verifikasi)
            $table->foreignId('penyimak_id')->nullable()->constrained()->nullOnDelete();

            // tanggal setoran
            $table->date('tanggal');

            // hafalan
            $table->integer('juz');

            $table->string('surat_mulai');
            $table->string('ayat_mulai');

            $table->string('surat_selesai');
            $table->string('ayat_selesai');

            // tasmi'
            $table->boolean('is_tasmi')->default(false);

            // status sistem
            $table->enum('status', ['pending', 'diterima', 'revisi'])
                ->default('pending');

            // penilaian (khususnya penting kalau tasmi')
            $table->enum('nilai', [
                'mumtaz',
                'jayyid_jiddan',
                'jayyid',
                'hasbuk'
            ])->nullable();

            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setorans');
    }
};
