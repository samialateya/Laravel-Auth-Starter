<?php

namespace Database\Seeders;

use App\Models\AdminType;
use Illuminate\Database\Seeder;

class AdminTypeSeeder extends Seeder
{
	public function run()
	{
		AdminType::upsert(
			[
				[
					'id' => 1,
					'name' => 'Super Admin',
					'description' => 'Can do anything',
				],
				[
					'id' => 2,
					'name' => 'Editor',
					'description' => 'low level that super admin'
				]
			],
			['name', 'description'],['id','name']
		);
	}
}
