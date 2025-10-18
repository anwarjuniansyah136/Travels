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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();

            // relasi ke user (pelanggan)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // relasi ke bus (yang dipesan)
            $table->foreignId('bus_id')->constrained('buses')->onDelete('cascade');

            // data reservasi
            $table->string('nama');
            $table->string('email');
            $table->string('telepon');
            $table->date('tanggal_berangkat');
            $table->date('tanggal_pulang')->nullable();
            $table->integer('jumlah_penumpang');
            $table->text('catatan')->nullable();

            // status reservasi (pending, approved, rejected)
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
