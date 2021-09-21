<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Str;
use Hash;

class DeveloperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        for ($x = 0; $x <= 10; $x++) {
            $randomNumber = rand(1, 9);
            \DB::table('developers')->insert([
                'first_name' => Str::random(10),
                'last_name' => Str::random(10),
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('password'),
                'phone_number' => '0'.$randomNumber,
            ]);
        }
    }
}
