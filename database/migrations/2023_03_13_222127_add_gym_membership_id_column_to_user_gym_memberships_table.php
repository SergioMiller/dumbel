<?php

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
            $table->bigInteger('gym_membership_id')->index()->after('gym_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_gym_memberships', static function (Blueprint $table) {
            $table->dropColumn('gym_membership_id');
        });
    }
};
