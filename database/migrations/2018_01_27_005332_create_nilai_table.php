<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNilaiTable extends Migration {

	public function up()
	{
		Schema::create('nilai', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('siswa')->unsigned()->nullable();
			$table->integer('kelas')->unsigned()->nullable();
			$table->float('nilai_kelas4_s1');
			$table->float('nilai_kelas4_s2');
			$table->float('nilai_kelas5_s1');
			$table->float('nilai_kelas5_s2');
			$table->float('nilai_kelas6_s1');
			$table->float('uas');
		});
	}

	public function down()
	{
		Schema::drop('nilai');
	}
}