<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFasilitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fasilitas', function (Blueprint $table) {
            $table->increments('id_fasilitas');
            $table->string('nama_fasilitas');
            $table->string('kapasitas');
            $table->string('lokasi');
            $table->string('fasilitas');
            $table->string('waktu_pemanfaatan');
            $table->text('file')->nullable();
            $table->string('nama')->nullable();
            $table->string('extension')->nullable();
            $table->integer('size')->nullable();
            $table->string('mime')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fasilitas');
    }
}
