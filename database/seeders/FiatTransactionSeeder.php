<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FiatTransaction;
use App\Models\User;
use Faker\Factory as Faker;

class FiatTransactionSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $users = User::all();

        foreach ($users as $user) {
            FiatTransaction::create([
                'user_id' => $user->id,
                'fiat_currency' => $faker->randomElement(['THB', 'USD']),
                'amount' => $faker->randomFloat(2, 100, 10000),
                'transaction_type' => $faker->randomElement(['DEPOSIT', 'WITHDRAW']),
                'status' => $faker->randomElement(['PENDING', 'SUCCESS', 'FAILED']),
            ]);
        }
    }
}
