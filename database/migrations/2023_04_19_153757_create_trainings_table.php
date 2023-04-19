<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trainings', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('gym_id');
            $table->foreignId('user_id');
            $table->foreignId('user_gym_membership_id')->nullable();
            $table->foreignId('trainer_id')->nullable();
            $table->foreignId('manager_id');
            $table->dateTime('started_at');
            $table->dateTime('finished_at')->nullable();
            $table->integer('locker_number')->nullable();
            $table->timestamps();

            $table->foreign('gym_id')->references('id')->on('gyms');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('user_gym_membership_id')->references('id')->on('user_gym_memberships');
            $table->foreign('trainer_id')->references('id')->on('users');
            $table->foreign('manager_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainings');
    }
};
