<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'test',
            'first_name' => 'duong',
            'last_name' => 'thanh',
            'email' => 'thanha2td3@gmail.com',
            'password' => bcrypt('12345678'),
            'isActive'=> '0',
            'isAdmin' => '1',
        ]);

        User::factory(10)->create();
    }
}
