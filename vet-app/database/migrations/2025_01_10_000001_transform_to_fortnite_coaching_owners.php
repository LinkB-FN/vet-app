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
        // Rename owners table to account_owners
        Schema::rename('owners', 'account_owners');

        // Update columns in account_owners table
        Schema::table('account_owners', function (Blueprint $table) {
            // Rename phone to discord_username
            $table->renameColumn('phone', 'discord_username');
            
            // Rename address to region
            $table->renameColumn('address', 'region');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert column names
        Schema::table('account_owners', function (Blueprint $table) {
            $table->renameColumn('discord_username', 'phone');
            $table->renameColumn('region', 'address');
        });

        // Rename table back
        Schema::rename('account_owners', 'owners');
    }
};
