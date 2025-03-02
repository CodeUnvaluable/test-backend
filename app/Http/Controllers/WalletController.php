<?php
namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function addWallet(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'crypto_type' => 'required|in:BTC,ETH,XRP,DOGE',
            'wallet_address' => 'required|unique:wallets,wallet_address'
        ]);

        $wallet = Wallet::create($request->all());

        return response()->json(['message' => 'Wallet added', 'wallet' => $wallet], 201);
    }

    public function getUserWallets($userId)
    {
        $wallets = Wallet::where('user_id', $userId)->get();
        return response()->json($wallets);
    }
}
