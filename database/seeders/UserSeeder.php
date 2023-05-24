<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Root',
            'email' => 'root@museoitc.com',
            'password' => '$2y$10$6CJKtHbC5JfqaFwFEXn/jOh5yWp.yWY3U0wz3cvCXWjGxsIf6XUmy'
        ]);
        User::create([
            'name' => 'Marco Rodriguez',
            'email' => 'marco@museoitc.com',
            'password' => '$2y$10$wqh/sqNWYxJsRFvLg7cPiuZCUwhA4dO9Avk4bfAkGtdZLaHYsYarW'
        ]);
    }
}
