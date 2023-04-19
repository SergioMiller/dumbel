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
        Schema::create('user_gym_membership_freezes', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_gym_membership_id')->index();
            $table->date('date_start');
            $table->date('date_end');
            $table->integer('day_quantity');
            $table->timestamps();

            $table->foreign('user_gym_membership_id')->references('id')->on('user_gym_memberships')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_gym_membership_freezes');
    }
};
