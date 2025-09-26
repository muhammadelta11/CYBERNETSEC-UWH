<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class FixRekeningClassTypeEnum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // First, let's check what the current enum values are
        $columns = DB::select("SHOW COLUMNS FROM rekening WHERE Field = 'class_type'");
        $currentEnum = $columns[0]->Type;

        // If the enum doesn't include 'brainlabs', we need to modify it
        if (strpos($currentEnum, "'brainlabs'") === false) {
            // Drop the existing enum column
            Schema::table('rekening', function (Blueprint $table) {
                $table->dropColumn('class_type');
            });

            // Recreate it with the correct enum values
            Schema::table('rekening', function (Blueprint $table) {
                $table->enum('class_type', ['upskill', 'brainlabs', 'all'])->after('payment_type')->default('upskill');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop the column and recreate with old values if needed
        Schema::table('rekening', function (Blueprint $table) {
            $table->dropColumn('class_type');
        });

        Schema::table('rekening', function (Blueprint $table) {
            $table->enum('class_type', ['upskill', 'skillabs', 'all'])->after('payment_type')->default('upskill');
        });
    }
}
