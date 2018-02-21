<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKelasTable extends Migration {

	public function up()
	{
		Schema::create('kelas', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('nama_kelas');
			$table->integer('tahun_ajaran')->unsigned()->nullable();
			$table->integer('wali_kelas')->unsigned()->nullable();
		});
	}

	public function down()
	{
		Schema::drop('kelas');
	}
}