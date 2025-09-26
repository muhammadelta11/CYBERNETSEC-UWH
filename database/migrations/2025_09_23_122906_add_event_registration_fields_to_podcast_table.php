<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEventRegistrationFieldsToPodcastTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('podcast', function (Blueprint $table) {
            if (!Schema::hasColumn('podcast', 'is_event')) {
                $table->boolean('is_event')->default(false)->after('description_podcast');
            }
            if (!Schema::hasColumn('podcast', 'quota')) {
                $table->integer('quota')->nullable()->after('is_event');
            }
            if (!Schema::hasColumn('podcast', 'registration_open')) {
                $table->datetime('registration_open')->nullable()->after('quota');
            }
            if (!Schema::hasColumn('podcast', 'registration_close')) {
                $table->datetime('registration_close')->nullable()->after('registration_open');
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
        Schema::table('podcast', function (Blueprint $table) {
            if (Schema::hasColumn('podcast', 'registration_close')) {
                $table->dropColumn('registration_close');
            }
            if (Schema::hasColumn('podcast', 'registration_open')) {
                $table->dropColumn('registration_open');
            }
            if (Schema::hasColumn('podcast', 'quota')) {
                $table->dropColumn('quota');
            }
            if (Schema::hasColumn('podcast', 'is_event')) {
                $table->dropColumn('is_event');
            }
        });
    }
}
