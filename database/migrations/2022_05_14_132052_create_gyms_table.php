<?php
declare(strict_types=1);

use App\Enums\GymStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('gyms', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('name');
            $table->string('description', 512)->nullable();
            $table->bigInteger('phone')->nullable();
            $table->string('email', 512)->nullable();
            $table->string('address', 512)->nullable();
            $table->string('status', 32)->default(GymStatusEnum::MODERATION->value);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gyms');
    }
};
