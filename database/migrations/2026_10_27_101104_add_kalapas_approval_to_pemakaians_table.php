<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pemakaians', function (Blueprint $table) {
            $table->string('kalapas_token', 64)->nullable()->after('status');
            $table->timestamp('kalapas_approved_at')->nullable()->after('kalapas_token');
            $table->string('kalapas_note', 255)->nullable()->after('kalapas_approved_at');
        });

        // Tambah 'Menunggu Kalapas' ke enum status
        DB::statement("ALTER TABLE pemakaians MODIFY status ENUM(
            'Menunggu',
            'Menunggu Kalapas',
            'Disetujui',
            'Ditolak',
            'Selesai'
        ) DEFAULT 'Menunggu'");
    }

    public function down(): void
    {
        Schema::table('pemakaians', function (Blueprint $table) {
            $table->dropColumn(['kalapas_token', 'kalapas_approved_at', 'kalapas_note']);
        });

        DB::statement("ALTER TABLE pemakaians MODIFY status ENUM(
            'Menunggu',
            'Disetujui',
            'Ditolak',
            'Selesai'
        ) DEFAULT 'Menunggu'");
    }
};
