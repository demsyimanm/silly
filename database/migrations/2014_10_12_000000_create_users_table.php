<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('nama');
            $table->string('role_id');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('role', function (Blueprint $table) {
            $table->increments('id'); 
            $table->string('nama');
            $table->timestamps();
        });

        Schema::create('kategori', function (Blueprint $table) {
            $table->increments('id'); 
            $table->string('nama');
            $table->timestamps();
        });

        Schema::create('informasi', function (Blueprint $table) {
            $table->increments('id'); 
            $table->string('nama');
            $table->string('kategori_id');
            $table->string('alamat');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('data',2048);
            $table->timestamps();
        });

        Schema::create('foto', function (Blueprint $table) {
            $table->increments('id'); 
            $table->string('nama');
            $table->string('informasi_id');
            $table->timestamps();
        });

        Schema::create('relasi', function (Blueprint $table) {
            $table->increments('id'); 
            $table->string('fotoparent');
            $table->string('fotochild');
            $table->string('derajat');
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
        Schema::dropIfExists('users');
    }
}
