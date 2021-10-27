<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDashboardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('news_bulletin')) {
            Schema::create('news_bulletin', function (Blueprint $table) {
                $table->increments('id');
                $table->timestamps();

                $table->string('title')->nullable();
                $table->string('content', 4000)->nullable();
                $table->boolean('is_visible')->default(true);

                $table->string('filename')->nullable();
                $table->string('path')->nullable();
                $table->char('size')->nullable();

                $table->string('creator')->nullable();
            });
        }

        if (!Schema::hasTable('booking_guideline')) {
            Schema::create('booking_guideline', function (Blueprint $table) {
                $table->increments('id');
                $table->timestamps();

                $table->string('title')->nullable();
                $table->string('content', 4000)->nullable();
                $table->string('filename')->nullable();
                $table->string('path')->nullable();
                $table->char('size')->nullable();

                $table->string('creator')->nullable();
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
        // Schema::dropIfExists('news_bulletin');
    }
}
