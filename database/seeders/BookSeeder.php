<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\carbon;
use Faker\Factory;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Factory::create('en_US');

        for ($i = 0; $i < 50; $i++) {
            DB::table('books')->insert([
                'title' => $faker->streetName(),
                'description' => $faker->realText(),
                'author' => $faker->name(),
                'created_at' => carbon::now(),
                'updated_at' => carbon::now(),
            ]);
        }
    }
}