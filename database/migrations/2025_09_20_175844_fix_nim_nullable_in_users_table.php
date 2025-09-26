<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class FixNimNullableInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Use raw SQL to ensure nim column becomes nullable
        DB::statement('ALTER TABLE users MODIFY COLUMN nim VARCHAR(255) NULL');
        
        // Also remove unique constraint if it exists and recreate it to allow nulls
        try {
            DB::statement('ALTER TABLE users DROP INDEX users_nim_unique');
        } catch (\Exception $e) {
            // Index might not exist, ignore error
        }
        
        // Recreate unique index that allows nulls (MySQL syntax)
        DB::statement('ALTER TABLE users ADD UNIQUE KEY users_nim_unique (nim)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Revert back to NOT NULL
        DB::statement('ALTER TABLE users MODIFY COLUMN nim VARCHAR(255) NOT NULL');
    }
}
