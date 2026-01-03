<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Step 1: Update existing users with 'user' role to 'staff'
        DB::table('users')
            ->where('role', 'user')
            ->update(['role' => 'staff']);

        // Step 2: Change the column to ENUM('admin', 'staff') with default 'staff'
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'staff'])->default('staff')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Step 1: Change column back to string
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('user')->change();
        });

        // Step 2: Optional: revert 'staff' roles back to 'user' (if needed)
        DB::table('users')
            ->where('role', 'staff')
            ->update(['role' => 'user']);
    }
};