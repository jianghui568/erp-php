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
        Schema::create('sku_log', function (Blueprint $table) {
            $table->id();
            $table->integer('goods_id');
            $table->integer('order_id')->default(0)->comment('订单id');
            $table->integer('entry_id')->default(0)->comment('入库单id');
            $table->integer('admin_id');
            $table->string('goods_sku');
            $table->string('action');
            $table->integer('action_sku_num');
            $table->integer('sku_stock_begin');
            $table->integer('sku_stock_end');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sku_log');
    }
};
