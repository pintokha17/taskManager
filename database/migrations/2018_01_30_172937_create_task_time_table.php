<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskTimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_time', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('start');
            $table->dateTime('pause')->nullable();
            $table->smallInteger('is_active');
            $table->integer('task_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_time');
    }
}
