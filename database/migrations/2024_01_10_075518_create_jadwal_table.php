<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal', function (Blueprint $table) {
            $table->increments('id_jadwal');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->unsignedInteger('permohonan_id');
            $table->date('tgl_mulai');
            $table->string('jam_mulai');
            $table->date('tgl_selesai');
            $table->string('jam_selesai');
            $table->timestamps();

            $table->foreign('permohonan_id')->references('id_permohonan')->on('permohonan')->onDelete('cascade ');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwal');
    }
}
