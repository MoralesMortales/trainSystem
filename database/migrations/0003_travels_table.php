<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('travels', function (Blueprint $table) {
            $table->string('travelCode')->primary();
            $table->unsignedBigInteger('train_id');
            $table->date('departureDay');
            $table->string('departureHour');
            $table->string('origin');
            $table->string('destiny');
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->foreign('train_id')->references('id')->on('trains');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
