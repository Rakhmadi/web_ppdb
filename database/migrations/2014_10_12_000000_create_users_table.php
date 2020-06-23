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
            $table->increments('id');
            $table->string('name');
            $table->string('password')->unique();
            $table->string('token');
            $table->string('admin_input')->nullable();
            //
            //
            $table->string('namalengkap')->nullable();
            $table->string('noreg')->unique();
            $table->string('nisn')->nullable();
            $table->text('tmplahir')->nullable();
            $table->date('tgllahir')->nullable();
            $table->string('agama')->nullable();
            $table->text('jeniskelamin')->nullable();
            $table->text('asalsekolah')->nullable();
            $table->text('alamat')->nullable();
            $table->integer('no_hp',255)->nullable();
            $table->string('upload_kk')->nullable();
            $table->string('akte')->nullable();
            $table->text('prod')->nullable();
            $table->text('prod1')->nullable();
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
        Schema::dropIfExists('users');
    }
}
