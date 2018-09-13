<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnBayar2Order extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('tb_order', 'jml_bayar')) {
            Schema::table('tb_order', function(Blueprint $table) {
                $table->double('jml_bayar')->nullable();
            });
        }
        if (!Schema::hasColumn('tb_order', 'jml_kembali')) {
            Schema::table('tb_order', function(Blueprint $table) {
                $table->double('jml_kembali')->nullable();
            });
        }
        if (!Schema::hasColumn('tb_order', 'pemasukan')) {
            Schema::table('tb_order', function(Blueprint $table) {
                $table->double('pemasukan')->nullable();
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
        //
    }
}
