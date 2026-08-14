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
        $tables = ['pendidikans', 'penelitians', 'pengabdians', 'penunjangs'];
        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $t) {
                $t->string('semester')->nullable()->after('uraian_kegiatan');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = ['pendidikans', 'penelitians', 'pengabdians', 'penunjangs'];
        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $t) {
                $t->dropColumn('semester');
            });
        }
    }
};
