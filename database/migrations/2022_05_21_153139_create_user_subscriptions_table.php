<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('gym_id');
            $table->foreignId('administrator_id');

            $table->string('name');
            $table->integer('day_quantity');
            $table->integer('works_from');
            $table->integer('works_to');
            $table->integer('training_quantity')->nullable();
            $table->integer('price');
            $table->dateTime('created_at');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('gym_id')->references('id')->on('gyms');
            $table->foreign('administrator_id')->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_subscriptions');
    }
};
