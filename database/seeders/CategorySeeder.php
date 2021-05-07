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

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'libelle' => 'sport',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('categories')->insert([
            'libelle' => 'cuisines',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('categories')->insert([
            'libelle' => 'jeux',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('categories')->insert([
            'libelle' => 'science',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('categories')->insert([
            'libelle' => 'actualités',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('categories')->insert([
            'libelle' => 'découverte',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

    }
}
