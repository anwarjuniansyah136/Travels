<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
       Schema::create('bus_type', function (Blueprint $table) {
    $table->id();
    $table->string('nama_tipe', 100);
    $table->string('deskripsi', 255);
    $table->timestamps();
});

    }

    public function down(): void
{
    Schema::dropIfExists('bus_type');
}

};
