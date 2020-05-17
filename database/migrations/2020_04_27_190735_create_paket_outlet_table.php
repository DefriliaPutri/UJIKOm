<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaketOutletTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outlet_paket', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('paket_id')->unsigned()->nullable();
            $table->integer('outlet_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('paket_id')->references('id')->on('pakets');
            $table->foreign('outlet_id')->references('id')->on('outlets');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('outlet_paket');
    }
}
