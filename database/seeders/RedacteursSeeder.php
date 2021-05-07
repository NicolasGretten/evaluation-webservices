<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Core\Number;
use Faker\Generator;
use Faker\Guesser\Name;
use Faker\Provider\Address;
use Faker\Provider\en_GB\PhoneNumber;
use Faker\Provider\fr_FR\Internet;
use Faker\Provider\fr_FR\Person;
use Faker\Provider\Lorem;
use Illuminate\Container\Container;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RedacteursSeeder extends Seeder
{
    /**
     * The current Faker instance.
     *
     * @var \Faker\Generator
     */
    protected $faker;

    public function __construct()
    {
        $this->faker = $this->withFaker();
    }

    /**
     * Get a new Faker instance.
     *
     * @return \Faker\Generator
     */
    protected function withFaker()
    {
        return Container::getInstance()->make(Generator::class);
    }
    /**
     *
     * @return void
     */
    public function run()
    {

        for ($i = 0; $i<10; $i++)
        {
            DB::table('redacteurs')->insert([
                'nom'               => $this->faker->lastName,
                'prenom'            => $this->faker->firstName(),
                'email'             => $this->faker->unique()->freeEmail,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now()
            ]);
        }

    }
}
