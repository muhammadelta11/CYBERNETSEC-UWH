<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMissingPaymentFieldsToRekeningTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rekening', function (Blueprint $table) {
            if (!Schema::hasColumn('rekening', 'payment_type')) {
                $table->string('payment_type')->after('atas_nama')->default('bank_transfer');
            }
            if (!Schema::hasColumn('rekening', 'class_type')) {
                $table->enum('class_type', ['upskill', 'brainlabs', 'all'])->after('payment_type')->default('upskill');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rekening', function (Blueprint $table) {
            if (Schema::hasColumn('rekening', 'payment_type')) {
                $table->dropColumn('payment_type');
            }
            if (Schema::hasColumn('rekening', 'class_type')) {
                $table->dropColumn('class_type');
            }
        });
    }
}
