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
            $table->decimal('CostVIP', 8, 2);
            $table->decimal('CostNormal', 8, 2);
            $table->decimal('CostTurists', 8, 2);
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->foreign('train_id')->references('train_id')->on('trains');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
