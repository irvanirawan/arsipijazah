<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSiswaTable extends Migration {

	public function up()
	{
		Schema::create('siswa', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('nama');
			$table->string('nis');
			$table->string('tempat_lahir');
			$table->date('tanggal_lahir');
			$table->string('jenis_kelamin');
			$table->string('agama');
			$table->text('alamat');
			$table->string('nama_ortu');
		});
	}

	public function down()
	{
		Schema::drop('siswa');
	}
}