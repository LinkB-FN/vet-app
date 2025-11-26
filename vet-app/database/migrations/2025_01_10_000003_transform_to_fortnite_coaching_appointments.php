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
        // Rename appointments table to coaching_sessions
        Schema::rename('appointments', 'coaching_sessions');

        // Update columns in coaching_sessions table
        Schema::table('coaching_sessions', function (Blueprint $table) {
            // Rename pet_id to fortnite_account_id
            $table->renameColumn('pet_id', 'fortnite_account_id');
            
            // Rename user_id to coach_id (keeping same reference to users table)
            $table->renameColumn('user_id', 'coach_id');
            
            // Rename appointment_date to session_date
            $table->renameColumn('appointment_date', 'session_date');
            
            // Rename reason to session_type
            $table->renameColumn('reason', 'session_type');
        });

        // Update foreign key constraints
        Schema::table('coaching_sessions', function (Blueprint $table) {
            $table->dropForeign(['fortnite_account_id']);
            $table->dropForeign(['coach_id']);
            
            $table->foreign('fortnite_account_id')->references('id')->on('fortnite_accounts')->onDelete('cascade');
            $table->foreign('coach_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert foreign keys
        Schema::table('coaching_sessions', function (Blueprint $table) {
            $table->dropForeign(['fortnite_account_id']);
            $table->dropForeign(['coach_id']);
            
            $table->foreign('fortnite_account_id')->references('id')->on('pets')->onDelete('cascade');
            $table->foreign('coach_id')->references('id')->on('users')->onDelete('set null');
        });

        // Revert column names
        Schema::table('coaching_sessions', function (Blueprint $table) {
            $table->renameColumn('fortnite_account_id', 'pet_id');
            $table->renameColumn('coach_id', 'user_id');
            $table->renameColumn('session_date', 'appointment_date');
            $table->renameColumn('session_type', 'reason');
        });

        // Rename table back
        Schema::rename('coaching_sessions', 'appointments');
    }
};
