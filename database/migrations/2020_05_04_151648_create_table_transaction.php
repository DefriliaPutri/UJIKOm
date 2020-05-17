<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->text('kode_invoice', 100);
            $table->date('tgl');
            $table->date('batas_waktu');
            $table->date('tgl_byr');
            $table->integer('biaya_tmbhn');
            $table->integer('paket_id')->unsigned()->nullable();
            $table->integer('diskon');
            $table->integer('pajak');
            $table->enum('status', ['baru', 'proses', 'selesai', 'diambil']);
            $table->enum('ket', ['dibayar', 'blm']);
            $table->integer('created_by');
            $table->integer('total');
            $table->timestamps();

            $table->foreign('paket_id')->references('id')->on('pakets')->onDelete('cascade');

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
