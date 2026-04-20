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
        Schema::table('murojaah_logs', function (Blueprint $table) {
            $table->foreignId('target_id')
                ->nullable()
                ->constrained('targets')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('murojaah_logs', function (Blueprint $table) {
            $table->dropColumn('target_id');
        });
    }

    
};
