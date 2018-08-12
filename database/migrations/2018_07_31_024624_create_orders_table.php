<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('会员id');
            $table->integer('shop_id')->comment('商铺id');
            $table->string('order_code')->comment('订单号');
            $table->string('order_birth_time')->comment('订单生成时间');
            $table->string('name')->comment('姓名');
            $table->string('tel')->comment('电话');
            $table->string('provence')->comment('省');
            $table->string('city')->comment('市');
            $table->string('area')->comment('区');
            $table->string('order_address')->comment('详细地址');
            $table->decimal('order_price')->comment('价格');
            $table->tinyInteger('status')->comment('状态(-1:已取消,0:待支付,1:待发货,2:待确认,3:完成)');
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
        Schema::dropIfExists('orders');
    }
}
