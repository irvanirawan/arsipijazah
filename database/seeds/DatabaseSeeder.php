<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	public function run()
	{
		Model::unguard();

		$this->call('SiswaTableSeeder');
		$this->command->info('Siswa table seeded!');

		$this->call('TahunajaranTableSeeder');
		$this->command->info('Tahunajaran table seeded!');

		$this->call('KelasModelTableSeeder');
		$this->command->info('KelasModel table seeded!');
	}
}