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
        Schema::create('pendidikans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('uraian_kegiatan');
            $table->date('tanggal')->nullable();
            $table->string('satuan_hasil')->nullable();
            $table->decimal('volume', 8, 2)->default(0);
            $table->decimal('angka_kredit', 8, 2)->default(0);
            $table->decimal('jumlah_angka_kredit', 8, 2)->default(0);
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendidikans');
    }
};
