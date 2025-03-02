<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function createOrder(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'order_type' => 'required|in:BUY,SELL',
            'crypto_type' => 'required|in:BTC,ETH,XRP,DOGE',
            'amount' => 'required|numeric|min:0.0001',
            'price' => 'required|numeric|min:0.01'
        ]);

        $order = Order::create($request->all());

        return response()->json(['message' => 'Order created', 'order' => $order], 201);
    }

    public function getOrder($id)
    {
        $order = Order::with('user')->find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        return response()->json($order);
    }

    public function getUserOrders($userId)
    {
        $orders = Order::where('user_id', $userId)->get();
        return response()->json($orders);
    }
}
