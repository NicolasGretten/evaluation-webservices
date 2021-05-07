<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Core\Number;
use Faker\Guesser\Name;
use Faker\Provider\Address;
use Faker\Provider\en_GB\PhoneNumber;
use Faker\Provider\Lorem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'john',
            'email' => 'john@doe.com',
            'password' =>  Hash::make('1234'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
