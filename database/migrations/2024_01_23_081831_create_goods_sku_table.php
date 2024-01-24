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
        Schema::create('goods_sku', function (Blueprint $table) {
            $table->id();
            $table->integer('goods_id')->comment('商品主键');
            $table->integer('stock')->comment('库存');
            $table->string('pic')->comment('图片');
            $table->string('unit')->default('')->comment('商品单位');
            $table->string('sku')->comment('多属性');
            $table->decimal('purchase_price')->default(0)->comment('采购价');
            $table->decimal('retail_price')->default(0)->comment('零售');
            $table->json('sku_meta')->comment('原始数据');
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
        Schema::dropIfExists('goods_sku');
    }
};
