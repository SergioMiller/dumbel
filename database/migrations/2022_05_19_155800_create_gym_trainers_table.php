<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gym_trainer', static function (Blueprint $table) {
            $table->foreignId('gym_id');
            $table->foreignId('user_id');

            $table->foreign('gym_id')->references('id')->on('gyms')->cascadeOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();

            $table->unique(['gym_id','user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gym_trainer');
    }
};
