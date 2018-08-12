<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('活动标题');
            $table->text('content')->comment('活动详情');
            $table->integer('signup_start')->comment('活动开始时间');
            $table->integer('signup_end')->comment('活动结束时间');
            $table->date('prize_date')->comment('开奖时间');
            $table->integer('signup_num')->comment('报名人数限制');
            $table->integer('is_prize')->comment('是否开奖');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
