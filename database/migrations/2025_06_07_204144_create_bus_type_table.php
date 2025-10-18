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
        Schema::create('bus_type', function (Blueprint $table) {
            $table->id();
            $table->varchar('type', 100);
            $table->decimal('price', 10,2);
            $table->text('facility');
            $table->varchar('seat_capacity', );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bus_type');
    }
};
