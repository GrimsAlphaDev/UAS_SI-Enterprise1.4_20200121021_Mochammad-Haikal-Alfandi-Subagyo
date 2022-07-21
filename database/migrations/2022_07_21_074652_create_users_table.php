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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nip')->nullable();
            $table->bigInteger('nim')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            // related to kelas table
            $table->bigInteger('kelas_id')->nullable()
                ->unsigned()
                ->index();
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade')->onUpdate('cascade');
            $table->string('jenis_kelamin');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role');
            $table->rememberToken();
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
        Schema::dropIfExists('user');
    }
};
