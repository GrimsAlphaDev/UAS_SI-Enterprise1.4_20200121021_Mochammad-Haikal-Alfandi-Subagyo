<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absens', function (Blueprint $table) {
            $table->id();
            $table->timestamp('waktu_absen');
            $table->unsignedBigInteger('mahasiswa_id');
            $table->unsignedBigInteger('matakuliah_id');
            // enum with value (hadir, tidak hadir)
            $table->enum('keterangan', ['Hadir', 'Tidak Hadir']);
            // relation with mahasiswa
            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            // relation with matakuliah
            $table->foreign('matakuliah_id')->references('id')->on('matakuliahs')
                ->onDelete('cascade')
                ->onUpdate('cascade');;
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
        Schema::dropIfExists('absens');
    }
};
