<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kewajiban_khususes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('uraian_kegiatan');
            $table->string('semester')->nullable();
            $table->string('satuan_hasil')->nullable();
            $table->decimal('volume', 8, 2)->default(0);
            $table->decimal('angka_kredit', 8, 2)->default(0);
            $table->decimal('jumlah_angka_kredit', 8, 2)->default(0);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kewajiban_khususes');
    }
};
