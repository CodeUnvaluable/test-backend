<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            User::create([
                'username' => $faker->unique()->userName(),
                'email' => $faker->unique()->safeEmail(),
                'password' => Hash::make('password'),
                'name' => $faker->name(),
                'phone' => $faker->phoneNumber(),
                'balance_crypto_btc' => $faker->randomFloat(8, 0, 5),
                'balance_crypto_eth' => $faker->randomFloat(8, 0, 10),
                'balance_crypto_xrp' => $faker->randomFloat(8, 0, 100),
                'balance_crypto_doge' => $faker->randomFloat(8, 0, 1000),
            ]);
        }
    }
}
