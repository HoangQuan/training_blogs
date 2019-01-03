<?php

use Illuminate\Database\Seeder;
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
    	$faker = Faker\Factory::create();
    	DB::table('users')->truncate();
		User::create([
        	'name' => 'Quân',
        	'email' => 'someone@gmail.com',
        	'password' => Hash::make('12345678'),
        ]);
    }
}
