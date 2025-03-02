<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Wallet;
use App\Models\User;

class WalletSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();

        foreach ($users as $user) {
            Wallet::create([
                'user_id' => $user->id,
                'crypto_type' => 'BTC',
                'wallet_address' => '1A' . substr(md5($user->id), 0, 30)
            ]);

            Wallet::create([
                'user_id' => $user->id,
                'crypto_type' => 'ETH',
                'wallet_address' => '0x' . substr(md5($user->id . 'eth'), 0, 40)
            ]);
        }
    }
}
