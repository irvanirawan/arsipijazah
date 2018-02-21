<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWalikelasTable extends Migration {

	public function up()
	{
		Schema::create('walikelas', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('nip');
			$table->string('nama');
		});
	}

	public function down()
	{
		Schema::drop('walikelas');
	}
}