<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

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

	            'full_name' => 'administration',
	            'username' => 'administration',
	            'role' => 1,
	            'status' => 1,
	            'avatar' => 'some.png',

	            'email' => 'administration@gmail.com',

	            'password' => 'secret',

	        ]);
    }
}
