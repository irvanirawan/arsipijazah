<?php

use Illuminate\Database\Seeder;
use siswaModel\Siswa;

class SiswaTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('siswa')->delete();

		// siswa
		Siswa::create(array(
				'nama' => irvan,
				'nis' => 11198,
				'tempat_lahir' => Tangerang,
				'jenis_kelamin' => Laki-laki,
				'agama' => Islam,
				'alamat' => Sangiang,
				'nama_ortu' => Rahasia
			));
	}
}