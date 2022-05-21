<?php

use App\Constants\GymStatusConstant;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('gyms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('name');
            $table->string('description', 512)->nullable();
            $table->string('phone', 24)->nullable();
            $table->string('email', 512)->nullable();
            $table->string('address', 512)->nullable();
            $table->string('status',32)->default(GymStatusConstant::MODERATION);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
        });

        Schema::create('trainer_gym', function (Blueprint $table) {
            $table->foreignId('user_id');
            $table->foreignId('gym_id');

            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('gym_id')->references('id')->on('gyms')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trainer_gym');
        Schema::dropIfExists('gyms');
    }
};
