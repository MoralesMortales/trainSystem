<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {

            $table->id('reservationNumber');
            $table->string('travelCode');

            $table->unsignedBigInteger('cedula');

            $table->boolean('status')->default(true);
            $table->timestamps();


            $table->foreign('travelCode')->references('travelCode')->on('travels');
            $table->foreign('cedula')->references('cedula')->on('users');

            $table->index(['travelCode', 'cedula']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
