<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FiatTransaction;
use Illuminate\Support\Facades\Auth;

class FiatTransactionController extends Controller
{

    public function index()
    {
        $transactions = FiatTransaction::where('user_id', Auth::id())->get();
        return response()->json($transactions);
    }


    public function store(Request $request)
    {
        $request->validate([
            'fiat_currency' => 'required|in:THB,USD',
            'amount' => 'required|numeric|min:0.01',
            'transaction_type' => 'required|in:DEPOSIT,WITHDRAW',
        ]);

        $transaction = FiatTransaction::create([
            'user_id' => Auth::id(),
            'fiat_currency' => $request->fiat_currency,
            'amount' => $request->amount,
            'transaction_type' => $request->transaction_type,
            'status' => 'PENDING', 
        ]);

        return response()->json(['message' => 'Transaction created successfully.', 'transaction' => $transaction]);
    }


    public function show($id)
    {
        $transaction = FiatTransaction::where('user_id', Auth::id())->findOrFail($id);
        return response()->json($transaction);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:PENDING,SUCCESS,FAILED',
        ]);

        $transaction = FiatTransaction::where('user_id', Auth::id())->findOrFail($id);
        $transaction->update(['status' => $request->status]);

        return response()->json(['message' => 'Transaction status updated.', 'transaction' => $transaction]);
    }


    public function destroy($id)
    {
        $transaction = FiatTransaction::where('user_id', Auth::id())->findOrFail($id);
        $transaction->delete();

        return response()->json(['message' => 'Transaction deleted.']);
    }
}
