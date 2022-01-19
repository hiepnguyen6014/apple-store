<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_id')->unique();
            $table->string('cpu', 100)->nullable()->default('Không có');
            $table->string('screen', 100)->nullable()->default('Không có');
            $table->string('resolution', 100)->nullable()->default('Không có');
            $table->string('ram', 100)->nullable()->default('Không có');
            $table->string('weight', 100)->nullable()->default('Không có');
            $table->string('camera', 1000)->nullable()->default('Không có');
            $table->string('storage', 100)->nullable()->default('Không có');
            $table->string('pin', 100)->nullable()->default('Không có');
            $table->string('port', 100)->nullable()->default('Không có');
            $table->string('feature', 1000)->nullable()->default('Không có');
            $table->string('bluetooth', 100)->nullable()->default('Không có');
            $table->string('compatible', 100)->nullable()->default('Không có');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_detail');
    }
}
