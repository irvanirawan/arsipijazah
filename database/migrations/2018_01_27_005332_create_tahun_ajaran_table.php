<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTahunAjaranTable extends Migration {

	public function up()
	{
		Schema::create('tahun_ajaran', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('nama');
		});
	}

	public function down()
	{
		Schema::drop('tahun_ajaran');
	}
}