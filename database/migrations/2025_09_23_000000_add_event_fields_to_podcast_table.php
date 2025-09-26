<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEventFieldsToPodcastTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('podcast', function (Blueprint $table) {
            $table->date('event_date')->nullable()->after('description_podcast');
            $table->time('event_time')->nullable()->after('event_date');
            $table->string('location')->nullable()->after('event_time');
            $table->string('speaker')->nullable()->after('location');
            $table->integer('max_participants')->nullable()->after('speaker');
            $table->decimal('registration_fee', 10, 2)->nullable()->after('max_participants');
            $table->string('event_type')->default('online')->after('registration_fee'); // online/offline/hybrid
            $table->string('meeting_link')->nullable()->after('event_type');
            $table->string('thumbnail')->nullable()->after('meeting_link');
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
            $table->dropColumn([
                'event_date',
                'event_time',
                'location',
                'speaker',
                'max_participants',
                'registration_fee',
                'event_type',
                'meeting_link',
                'thumbnail'
            ]);
        });
    }
}
