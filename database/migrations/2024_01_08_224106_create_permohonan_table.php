<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermohonanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permohonan', function (Blueprint $table) {
            $table->increments('id_permohonan');
            $table->string('kode_booking')->nullable();
            $table->enum('skpd',['skpd','non_skpd']);
            $table->string('bidang_kegiatan');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('status_instansi')->nullable();
            $table->string('bidang_instansi')->nullable();

            $table->string('nama_kegiatan')->nullable();
            $table->string('jumlah_peserta')->nullable();
            $table->string('narasumber')->nullable();
            $table->string('output')->nullable();
            $table->string('outcome')->nullable();
            $table->string('ringkasan')->nullable();
            $table->string('surat_permohonan')->nullable();
            $table->string('rundown_acara')->nullable();

            $table->unsignedInteger('fasilitas_id')->nullable();
            $table->string('alat_id')->nullable();
            $table->enum('status_permohonan',['Diterima','Ditolak', 'Menunggu', 'Batal'])->default('Menunggu')->nullable();
            $table->string('catatan')->nullable();
            $table->string('catatan_tolak')->nullable();
            $table->timestamps();

            $table->foreign('fasilitas_id')->references('id_fasilitas')->on('fasilitas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permohonan');
    }
}
