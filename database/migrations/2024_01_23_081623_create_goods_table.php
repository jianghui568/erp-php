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
        Schema::create('goods', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->default(0)->index()->comment('分类');
            $table->integer('vendor_id')->default(0)->index()->comment('供应商');
            $table->string('name', 255)->default('')->comment('名称');
            $table->string('mfrs', 255)->default('')->comment('制造商');
            $table->string('model', 255)->default('')->comment('型号');
            $table->string('standard', 255)->default('')->comment('规格');
            $table->string('color', 255)->default('')->comment('颜色');
            $table->integer('expiry_num')->default(0)->comment('保质期');
            $table->json('sku_info')->nullable()->comment('skujson');
            $table->decimal('weight', 26,6)->default(0)->comment('基础重量kg');
            $table->boolean('enabled')->default(0)->comment('启用 0-禁用 1-启用');
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
        Schema::dropIfExists('goods');
    }
};
