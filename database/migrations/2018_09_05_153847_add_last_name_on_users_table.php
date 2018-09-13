<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLastNameOnUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        if (!Schema::hasColumn('users', 'last_name')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('last_name')->nullable()->after('name');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        if (Schema::hasColumn('users', 'last_name')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('last_name');
            });
        }
    }
}
