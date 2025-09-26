<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFileToSertifikatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sertifikats', function (Blueprint $table) {
            $table->string('file_sertifikat')->nullable()->after('tanggal_diterbitkan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sertifikats', function (Blueprint $table) {
            $table->dropColumn('file_sertifikat');
        });
    }
}
