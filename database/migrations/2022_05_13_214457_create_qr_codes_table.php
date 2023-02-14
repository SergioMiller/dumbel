<?php

use App\Enums\QrCodeSourceEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('qr_codes', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->uuid();
            $table->string('source')->default(QrCodeSourceEnum::AUTOMATIC->value);
            $table->dateTime('last_used_at')->nullable();
            $table->dateTime('created_at');

            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('qr_codes');
    }
};
