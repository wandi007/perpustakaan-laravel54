<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePinjamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('pinjams', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('id_user');
          $table->integer('id_buku');
          $table->date('tgl_pinjam');
          $table->date('tgl_kembali');
      });
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
