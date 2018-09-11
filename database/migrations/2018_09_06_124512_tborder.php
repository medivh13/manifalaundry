<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tborder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('tb_order')){
        Schema::create('tb_order',function(Blueprint $table){
          $table->increments('id');
          $table->string('code')->nullable();
          $table->string('customer')->nullable();
          $table->string('alamat')->nullable();
          $table->string('telp')->nullable();
          $table->string('keterangan')->nullable();
          $table->timestamps('tgl_selesai')->nullable();
          $table->integer('status_bayar')->nullable();
          $table->timestamps();
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
        Schema::dropIfExists('tb_order');
    }
}
