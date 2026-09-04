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
        // 1. Add custom columns to users table if not existing
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'description')) {
                $table->text('description')->nullable()->after('password');
            }
            if (!Schema::hasColumn('users', 'icon_path')) {
                $table->string('icon_path')->nullable()->after('description');
            }
            if (!Schema::hasColumn('users', 'revoked_at')) {
                $table->timestamp('revoked_at')->nullable()->after('icon_path');
            }
        });

        // 2. Create portfolios table if not existing
        if (!Schema::hasTable('portfolios')) {
            Schema::create('portfolios', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->string('url');
                $table->string('title')->nullable();
                $table->text('description')->nullable();
                $table->string('type')->nullable();
                $table->string('icon_path')->nullable();
                $table->string('first_token', 64)->nullable();
                $table->string('second_token', 64)->nullable();
                $table->string('display_flag', 1)->default('1');
                $table->timestamp('verified_at')->nullable();
                $table->timestamps();

                $table->index('user_id');
                $table->index('verified_at');
                $table->index('display_flag');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolios');

        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'description')) {
                $table->dropColumn('description');
            }
            if (Schema::hasColumn('users', 'icon_path')) {
                $table->dropColumn('icon_path');
            }
            if (Schema::hasColumn('users', 'revoked_at')) {
                $table->dropColumn('revoked_at');
            }
        });
    }
};
