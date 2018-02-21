<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('kelas', function(Blueprint $table) {
			$table->foreign('tahun_ajaran')->references('id')->on('tahun_ajaran')
						->onDelete('set null')
						->onUpdate('set null');
		});
		Schema::table('kelas', function(Blueprint $table) {
			$table->foreign('wali_kelas')->references('id')->on('walikelas')
						->onDelete('set null')
						->onUpdate('set null');
		});
		Schema::table('nilai', function(Blueprint $table) {
			$table->foreign('siswa')->references('id')->on('siswa')
						->onDelete('set null')
						->onUpdate('set null');
		});
		Schema::table('nilai', function(Blueprint $table) {
			$table->foreign('kelas')->references('id')->on('kelas')
						->onDelete('set null')
						->onUpdate('set null');
		});
	}

	public function down()
	{
		Schema::table('kelas', function(Blueprint $table) {
			$table->dropForeign('kelas_tahun_ajaran_foreign');
		});
		Schema::table('kelas', function(Blueprint $table) {
			$table->dropForeign('kelas_wali_kelas_foreign');
		});
		Schema::table('nilai', function(Blueprint $table) {
			$table->dropForeign('nilai_siswa_foreign');
		});
		Schema::table('nilai', function(Blueprint $table) {
			$table->dropForeign('nilai_kelas_foreign');
		});
	}
}