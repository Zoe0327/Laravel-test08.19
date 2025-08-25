<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('ja_JP');

        for ($i = 0; $i < 10; $i++) {
            DB::table('contacts')->insert([
                'category_id' => $faker->numberBetween(1, 5),
                'first_name'  => $faker->firstName,
                'last_name'   => $faker->lastName,
                'gender'      => $faker->numberBetween(1, 3),
                'email'       => $faker->safeEmail,
                'tel'        => preg_replace('/[^0-9]/', '', $faker->phoneNumber),
                'address'     => $faker->address,
                'building'    => $faker->secondaryAddress,
                'detail'     => $faker->realText(120),
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}
