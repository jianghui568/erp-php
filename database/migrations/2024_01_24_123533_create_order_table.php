<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->integer('platform_id')->default(0)->comment('平台id');
            $table->integer('admin_id')->default(0)->comment('添加人id');
            $table->integer('goods_id')->comment('商品id');
            $table->tinyInteger('state')->comment('1下单未发货，2已发货，3退款退货，4仅退款');
            $table->string('customer_name')->comment('用户名');
            $table->string('customer_phone')->comment('用户手机号');
            $table->string('customer_address')->comment('用户所在地');
            $table->string('customer_order_sn')->comment('用户订单号');
            $table->json('goods_sku_info')->nullable()->comment('货物的sku id对应数量');
            $table->string('goods_info')->default('')->comment('货物信息');
            $table->integer('goods_num')->default(0)->comment('商品数量');
            $table->dateTime('pay_at')->nullable()->comment('订单支付时间');
            $table->decimal('pay_money',20,2)->nullable()->comment('订单支付金额');
            $table->dateTime('return_at')->nullable()->comment('退货时间');
            $table->string('track_sn')->default('')->comment('物流单号');
            $table->softDeletes();
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
        Schema::dropIfExists('order');
    }
};
