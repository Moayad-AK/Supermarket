<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvailableProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('available_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            //$table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('category_id');
            $table->string('name');
            $table->string('image');
            $table->date('expire_date');
            $table->string('contact_info');
            $table->double('quantity');
            $table->double('raw_price');
            $table->string('unit');
            $table->integer('sale1');
            $table->integer('sale2');
            $table->integer('sale3');
            $table->integer('day1');
            $table->integer('day2');
            $table->integer('day3');
            $table->integer('view_count')->default(0);
            $table->integer('like_count')->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories');
            //$table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('available_products');
    }
}
