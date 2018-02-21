<?php

use Illuminate\Database\Seeder;
use \Tahunajaran;

class TahunajaranTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('tahun_ajaran')->delete();

		// tahun_ajaran
		Tahunajaran::create(array(
				'nama' => 2016/2017
			));
	}
}