<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_subscriptions', static function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('gym_id');
            $table->bigInteger('administrator_id');

            $table->string('name');
            $table->integer('day_quantity');
            $table->integer('works_from');
            $table->integer('works_to');
            $table->integer('training_quantity')->nullable();
            $table->integer('price');
            $table->dateTime('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_subscriptions');
    }
};
