<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddRejectedStatusToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Instead of using ->change() which requires Doctrine DBAL,
        // we'll use raw SQL to modify the enum
        DB::statement("ALTER TABLE users MODIFY COLUMN status ENUM('active', 'inactive', 'rejected') DEFAULT 'inactive'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE users MODIFY COLUMN status ENUM('active', 'inactive') DEFAULT 'inactive'");
    }
}
