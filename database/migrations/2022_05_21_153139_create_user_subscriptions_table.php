<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('user_gym_memberships', static function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->index();
            $table->bigInteger('gym_id')->index();
            $table->bigInteger('administrator_id')->index();

            $table->string('name');
            $table->integer('day_quantity');
            $table->integer('works_from');
            $table->integer('works_to');
            $table->integer('training_quantity')->nullable();
            $table->integer('price');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gym_memberships');
    }
};
