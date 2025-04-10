<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('es_PE'); // Usar un faker para datos peruanos

        $users = DB::table('users')->whereNull('nombres')->get();

        foreach ($users as $user) {
            DB::table('users')
                ->where('id', $user->id)
                ->update([
                    'nombres' => $faker->firstName,
                    'apellidos' => $faker->lastName,
                    'dni' => $faker->unique()->numerify('########')
                ]);
        }
    }
}