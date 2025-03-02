<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;
use Faker\Factory as Faker;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $users = User::all();

        foreach ($users as $user) {
            Order::create([
                'user_id' => $user->id,
                'order_type' => $faker->randomElement(['BUY', 'SELL']),
                'crypto_type' => $faker->randomElement(['BTC', 'ETH', 'XRP', 'DOGE']),
                'amount' => $faker->randomFloat(4, 0.01, 5),
                'price' => $faker->randomFloat(2, 1000, 50000),
                'status' => $faker->randomElement(['OPEN', 'CLOSED'])
            ]);
        }
    }
}
