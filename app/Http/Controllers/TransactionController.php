<?php
namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function transferCrypto(Request $request)
    {
        $request->validate([
            'from_user_id' => 'required|exists:users,id',
            'to_user_id' => 'required|exists:users,id|different:from_user_id',
            'crypto_type' => 'required|in:BTC,ETH,XRP,DOGE',
            'amount' => 'required|numeric|min:0.0001'
        ]);

        $fromUser = User::find($request->from_user_id);
        $toUser = User::find($request->to_user_id);
        $cryptoType = 'balance_crypto_' . strtolower($request->crypto_type);

        if ($fromUser->$cryptoType < $request->amount) {
            return response()->json(['message' => 'Insufficient balance'], 400);
        }

        $fromUser->$cryptoType -= $request->amount;
        $fromUser->save();

        $toUser->$cryptoType += $request->amount;
        $toUser->save();

        $transaction = Transaction::create([
            'from_user_id' => $request->from_user_id,
            'to_user_id' => $request->to_user_id,
            'crypto_type' => $request->crypto_type,
            'amount' => $request->amount,
            'transaction_type' => 'TRANSFER',
            'status' => 'SUCCESS'
        ]);

        return response()->json(['message' => 'Transfer successful', 'transaction' => $transaction], 200);
    }

    public function getTransaction($id)
    {
        $transaction = Transaction::with(['fromUser', 'toUser'])->find($id);

        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        return response()->json($transaction);
    }
}
