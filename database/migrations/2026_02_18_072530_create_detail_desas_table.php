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
                ->constrained('kabupatens')
                ->cascadeOnDelete();
            $table->foreignId('kecamatan_id')
                ->constrained('kecamatans')
                ->cascadeOnDelete();
            $table->foreignId('desa_id')
                ->unique()
                ->constrained('desas')
                ->cascadeOnDelete();
            $table->string('lokasi');
            $table->text('profil_desa');
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

            $table->unique(['provinsi_id', 'desa_id']);
            $table->unique(['kabupaten_id', 'desa_id']);
            $table->unique(['kecamatan_id', 'desa_id']);
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
