<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShoppingItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopping_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantity')->unsigned();
            $table->decimal('price', 8, 2)->nullable();
            $table->softDeletes();
            $table->timestamps();
            
            $table->integer('shopping_list_id')->unsigned()->index();
            $table->integer('product_id')->unsigned()->nullable();         
            $table->foreign('shopping_list_id')->references('id')->on('shopping_lists');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shopping_items');
    }
}
