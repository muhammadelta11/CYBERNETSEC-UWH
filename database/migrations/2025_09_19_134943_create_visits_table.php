<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address');
            $table->text('user_agent')->nullable();
            $table->string('page_url');
            $table->string('referrer')->nullable();
            $table->string('session_id')->nullable();
            $table->json('request_data')->nullable();
            $table->timestamp('visited_at');
            $table->timestamps();

            // Indexes for better performance
            $table->index(['ip_address', 'visited_at']);
            $table->index('page_url');
            $table->index('visited_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visits');
    }
}
