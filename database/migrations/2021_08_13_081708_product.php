<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Product extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('category_id')->unsigned();
          $table->integer('supplier_id')->unsigned();
          $table->integer('brand_id')->unsigned();
          $table->string('product_name');
          $table->string('product_quantity');
          $table->integer('product_price');
          $table->timestamps();

          $table->foreign('category_id')->references('id')->on('categories');
          $table->foreign('supplier_id')->references('id')->on('suppliers');
          $table->foreign('brand_id')->references('id')->on('brands');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
