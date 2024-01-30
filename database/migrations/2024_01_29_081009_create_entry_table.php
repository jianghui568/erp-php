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
        Schema::create('entry', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id')->default(0)->comment('添加人id');
            $table->integer('goods_id')->comment('商品id');
            $table->string('entry_sn')->comment('进货单号');
            $table->string('audit_state')->default(0)->comment('0待审核，1通过；2拒绝');
            $table->string('goods_info')->default('')->comment('货物信息');
            $table->integer('goods_num')->default(0)->comment('商品数量');
            $table->decimal('pay_money',20,2)->nullable()->comment('订单支付金额');
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
        Schema::dropIfExists('entry');
    }
};
