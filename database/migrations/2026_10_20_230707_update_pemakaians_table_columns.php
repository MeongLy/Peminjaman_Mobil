<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pemakaians', function (Blueprint $table) {
            $table->string('bidang')->nullable()->after('pengguna');
            $table->text('keterangan')->nullable()->after('status');

            $table->renameColumn('tanggal_pakai', 'tanggal');
        });
    }

    public function down(): void
    {
        Schema::table('pemakaians', function (Blueprint $table) {
            $table->dropColumn(['bidang', 'keterangan']);
            $table->renameColumn('tanggal', 'tanggal_pakai');
        });
    }
};
