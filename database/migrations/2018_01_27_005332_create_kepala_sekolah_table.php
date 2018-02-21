<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKepalaSekolahTable extends Migration {

	public function up()
	{
		Schema::create('kepala_sekolah', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('kepala_sekolah');
	}
}