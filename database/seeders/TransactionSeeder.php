<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\User;
use Faker\Factory as Faker;

class TransactionSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $users = User::all();

        foreach ($users as $user) {
            $otherUser = $users->where('id', '!=', $user->id)->random();

            Transaction::create([
                'from_user_id' => $user->id,
                'to_user_id' => $otherUser->id,
                'crypto_type' => $faker->randomElement(['BTC', 'ETH', 'XRP', 'DOGE']),
                'amount' => $faker->randomFloat(4, 0.01, 2),
                'transaction_type' => 'TRANSFER',
                'status' => 'SUCCESS'
            ]);
        }
    }
}
