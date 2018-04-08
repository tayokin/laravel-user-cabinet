<?php

declare(strict_types=1);

use Illuminate\Database\Seeder;

/**
 * Class UsersTableSeeder.
 */
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        for ($i=0; $i < 10; ++$i) {
            $randName = str_random(5);
            DB::table('users')->insert([
                'name'               => ucfirst($randName),
                'phone'              => '+380'.array_rand(['93', '67', '50', '66']).random_int(1000000, 9999999),
                'password'           => Hash::make($randName),
                'registration_token' => str_random(5),
            ]);
        }
    }
}
