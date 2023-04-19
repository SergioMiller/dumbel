<?php
declare(strict_types=1);

use App\Enums\GymMembershipStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('user_gym_memberships', static function (Blueprint $table) {
            $table->string('status')->default(GymMembershipStatusEnum::ACTIVE->value);
            $table->date('date_start')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_gym_memberships', static function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('date_start');
        });
    }
};
