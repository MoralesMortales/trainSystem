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
        Schema::create('trains', function (Blueprint $table) {
            $table->id('train_id')->unique();
            $table->string('type');
            $table->integer('capacity');
            $table->float('maxVelocity');
            $table->integer('vipCapacity');
            $table->integer('turistCapacity');
            $table->integer('economicCapacity');
            $table->timestamps();
        });

        }

    /**
     * Reverse the migrations.
     */

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
