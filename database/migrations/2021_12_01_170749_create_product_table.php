<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('name', 1000)->nullable();
            $table->integer('oldPrice')->nullable();
            $table->integer('newPrice')->nullable();
            $table->string('offer', 1000)->nullable();
            $table->double('rate')->nullable();
            $table->integer('sellQty')->nullable();
            $table->string('version', 20)->nullable();
            $table->integer('sale')->nullable();
            $table->string('img', 100)->nullable();
            $table->integer('type')->nullable();
            $table->integer('guarantee')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
