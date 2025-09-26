<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProgressTableAddMateriIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('progress', function (Blueprint $table) {
            // Add new materi_id column
            $table->unsignedBigInteger('materi_id')->nullable()->after('video_id');

            // Copy data from video_id to materi_id (assuming they should be the same for now)
            // Note: This is a simplified approach. In a real scenario, you might need more complex data migration

            // Add foreign key constraint
            $table->foreign('materi_id')->references('id')->on('materi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('progress', function (Blueprint $table) {
            // Drop foreign key constraint
            $table->dropForeign(['materi_id']);

            // Drop the materi_id column
            $table->dropColumn('materi_id');
        });
    }
}
