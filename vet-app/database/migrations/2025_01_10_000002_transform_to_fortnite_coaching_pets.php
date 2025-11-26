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
        // Rename pets table to fortnite_accounts
        Schema::rename('pets', 'fortnite_accounts');

        // Update columns in fortnite_accounts table
        Schema::table('fortnite_accounts', function (Blueprint $table) {
            // Rename name to epic_username
            $table->renameColumn('name', 'epic_username');
            
            // Rename species to platform
            $table->renameColumn('species', 'platform');
            
            // Rename breed to rank
            $table->renameColumn('breed', 'rank');
            
            // Rename birth_date to account_created_date
            $table->renameColumn('birth_date', 'account_created_date');
            
            // Rename owner_id to account_owner_id
            $table->renameColumn('owner_id', 'account_owner_id');
        });

        // Update foreign key constraint
        Schema::table('fortnite_accounts', function (Blueprint $table) {
            $table->dropForeign(['account_owner_id']);
            $table->foreign('account_owner_id')->references('id')->on('account_owners')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert foreign key
        Schema::table('fortnite_accounts', function (Blueprint $table) {
            $table->dropForeign(['account_owner_id']);
            $table->foreign('account_owner_id')->references('id')->on('owners')->onDelete('cascade');
        });

        // Revert column names
        Schema::table('fortnite_accounts', function (Blueprint $table) {
            $table->renameColumn('epic_username', 'name');
            $table->renameColumn('platform', 'species');
            $table->renameColumn('rank', 'breed');
            $table->renameColumn('account_created_date', 'birth_date');
            $table->renameColumn('account_owner_id', 'owner_id');
        });

        // Rename table back
        Schema::rename('fortnite_accounts', 'pets');
    }
};
