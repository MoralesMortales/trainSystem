<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('seats', function (Blueprint $table) {

            $table->id('reservingSeatId');
            $table->string('class');
            $table->integer('seat');
            $table->string('gender');
            $table->string('fullname');
            $table->integer('age');
            $table->integer('reservationNumber');

            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->foreign('reservationNumber')->references('reservationNumber')->on('reservations');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
