<?php

namespace App\Http\Controllers;

use App\Events\OrderCreatedEvent;
use App\Events\OrderDeletedEvent;
use App\Events\OrderUpdatedEvent;
use App\Models\item;
use App\Models\order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Cache::remember('orders', now()->addMinutes(10), function () {
            return order::with('items', 'user', 'table')->get();
        });

        return response()->json($orders);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'table_id' => 'nullable|exists:tables,id',
            'items' => 'required|array',
            'items.*.id' => 'required|exists:items,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $total = 0;
        $itemsData = [];
        foreach ($request->items as $itemData) {
            $item = item::find($itemData['id']);
            $itemsData[$item->id] = [
                'quantity' => $itemData['quantity'],
                'price' => $item->price,
            ];
            $total += $item->price * $itemData['quantity'];
        }

        $order = Order::create([
            'user_id' => $request->user_id,
            'table_id' => $request->table_id,
            'total' => $total,
            'status' => 'pending',
        ]);

        $order->items()->sync($itemsData);

        Cache::forget('orders');
        event(new OrderCreatedEvent($order));

        return response()->json($order->load('items', 'user', 'table'), 201);
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        $order->update(['status' => $request->status]);

        Cache::forget('orders');
        event(new OrderUpdatedEvent($order));

        return response()->json($order->load('items', 'user', 'table'));
    }

    public function destroy(Order $order)
    {
        $order->items()->detach();
        $order->delete();

        Cache::forget('orders');
        event(new OrderDeletedEvent($order));

        return response()->json(null, 204);
    }

}
