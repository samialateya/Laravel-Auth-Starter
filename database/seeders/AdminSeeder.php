<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      User::updateOrCreate(
			['name' => "admin"],
			[
				'name' => "admin",
				'email' => "admin@authstarter.com",
				'email_verified_at' => now(),
				'is_admin' => true,
				'admin_type' => 1, // for a super admin
				'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
				'remember_token' => Str::random(10),
			]);
    }
}
