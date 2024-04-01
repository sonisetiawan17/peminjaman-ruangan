<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('instansi_id')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('nik')->nullable()->unique();
            $table->string('no_telp')->nullable();
            $table->string('nama_instansi')->nullable();
            $table->string('alamat_instansi')->nullable();
            $table->string('tipe')->nullable();
            $table->timestamps();

            $table->foreign('instansi_id')->references('id_instansi')->on('instansi')->onDelete('cascade ');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
