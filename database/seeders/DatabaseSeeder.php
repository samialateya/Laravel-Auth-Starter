<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\AdminSeeder;
use Database\Seeders\AdminTypeSeeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		//create 10 random user
		// \App\Models\User::factory(10)->create();
		//fill admin types table
		(new AdminTypeSeeder)->run();
		//fill default admin credentials in the users table
		(new AdminSeeder)->run();
	}
}
