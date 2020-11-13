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
        Schema::create('users', function (Blueprint $table) {
            // $table->unique('IdDokter');
            // $table->string('NamaLengkap');
            // $table->string('KdRuangan');
            // $table->string('NamaRuangan');
            // $table->string('KdJabatan');
            // $table->string('password');
            $table->unique('ID');
            $table->string('Nama');
            $table->string('Password');
            $table->string('KodeRuangan');
            $table->string('NamaRuangan');
            $table->string('Role');
            $table->string('StatusLogin');
            $table->string('Status');
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
