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
        Schema::create('detail_desas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('provinsi_id')
                ->constrained('provinsis')
                ->cascadeOnDelete();
            $table->foreignId('kabupaten_id')
                ->nullable()
                ->constrained('kabupatens')
                ->nullOnDelete();
            $table->foreignId('kecamatan_id')
                ->nullable()
                ->constrained('kecamatans')
                ->nullOnDelete();
            $table->foreignId('desa_id')
                ->nullable()
                ->constrained('desas')
                ->nullOnDelete();
            $table->text('profil');
            $table->string('judul');
            $table->string('lokasi')->nullable();
            $table->json('foto')->nullable();
            $table->json('bahan_paparan')->nullable();
            $table->json('laporan')->nullable();
            $table->json('dokumen')->nullable();
            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->foreignId('updated_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_desas');
    }
};
