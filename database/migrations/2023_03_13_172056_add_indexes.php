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
        Schema::table('gyms', static function (Blueprint $table) {
            $table->index(['user_id']);
        });

        Schema::table('gym_memberships', static function (Blueprint $table) {
            $table->index(['gym_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gyms', static function (Blueprint $table) {
            $table->dropIndex('gyms_user_id_index');
        });

        Schema::table('gym_memberships', static function (Blueprint $table) {
            $table->dropIndex('gym_memberships_gym_id_index');
        });
    }
};