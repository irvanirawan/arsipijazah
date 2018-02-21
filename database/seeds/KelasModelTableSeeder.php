<?php

use Illuminate\Database\Seeder;
use \KelasModel;

class KelasModelTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('kelas')->delete();

		// kelas
		KelasModel::create(array(
				'nama_kelas' => 6 A,
				'tahun_ajaran' => 1
			));
	}
}