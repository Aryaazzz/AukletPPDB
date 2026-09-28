<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->text('bio')->nullable()->after('phone');
            $table->string('nis')->nullable()->after('bio');
            $table->string('role')->default('admin')->after('nis');
            $table->string('class_name')->nullable()->after('role');
            $table->decimal('wallet_balance', 15, 2)->default(0)->after('class_name');
            $table->integer('points')->default(0)->after('wallet_balance');
            $table->integer('violation_points')->default(0)->after('points');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'bio',
                'nis',
                'role',
                'class_name',
                'wallet_balance',
                'points',
                'violation_points',
            ]);
        });
    }
};
