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
        Schema::create('entry_sku', function (Blueprint $table) {
            $table->id();
            $table->integer('entry_id')->comment('入库单id');
            $table->string('sku')->default('')->comment('sku');
            $table->integer('num')->default(0)->comment('数量');
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
        Schema::dropIfExists('entry_sku');
    }
};
