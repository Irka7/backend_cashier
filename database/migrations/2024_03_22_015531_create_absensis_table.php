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
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->string('namaKaryawan');
            $table->date('tanggalMasuk');
            $table->timestamp('waktuMasuk')->useCurrent();
            $table->enum('status', ['Masuk', 'Sakit', 'Cuti']);
            $table->timestamp('waktuKeluar')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
