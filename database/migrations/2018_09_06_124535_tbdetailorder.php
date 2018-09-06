<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tbdetailorder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('tb_detail_order')){
        Schema::create('tb_detail_order',function(Blueprint $table){
          $table->increments('id');
          $table->integer('order_id')->index()->unsigned();
          $table->integer('product_id')->index()->unsigned();
          $table->integer('amount')->nullable();
        });
      }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_detail_order');
    }
}
