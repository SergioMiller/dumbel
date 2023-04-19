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
        Schema::table('gym_memberships', static function (Blueprint $table) {
            $table->integer('freeze_day_quantity')->nullable()->after('day_quantity');
        });

        Schema::table('user_gym_memberships', static function (Blueprint $table) {
            $table->integer('freeze_day_quantity')->nullable()->after('day_quantity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gym_memberships', static function (Blueprint $table) {
            $table->dropColumn('freeze_day_quantity');
        });

        Schema::table('user_gym_memberships', static function (Blueprint $table) {
            $table->dropColumn('freeze_day_quantity');
        });
    }
};
