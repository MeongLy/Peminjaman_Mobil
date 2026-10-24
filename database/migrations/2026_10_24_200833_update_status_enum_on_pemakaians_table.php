<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE pemakaians MODIFY status ENUM('Menunggu', 'Disetujui', 'Ditolak', 'Selesai') DEFAULT 'Menunggu'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE pemakaians MODIFY status ENUM('Menunggu', 'Disetujui', 'Ditolak') DEFAULT 'Menunggu'");
    }
};
