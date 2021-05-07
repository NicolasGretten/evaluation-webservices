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

class ArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i<10; $i++)
        {
            DB::table('articles')->insert([
                'titre'             => strtolower(Lorem::sentence(4)),
                'category_id'       => random_int(1,4),
                'redacteur_id'      => random_int(1,5),
                'resumeCourt'       => strtolower(Lorem::sentence(15)),
                'description'       => strtolower(Lorem::sentence(45)),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ]);
        }

    }
}
