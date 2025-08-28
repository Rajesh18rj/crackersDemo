<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->paginate(10);

        $newOrders = \App\Models\Order::where('status', 'new')->count();
        $processingOrders = \App\Models\Order::where('status', 'processing')->count();
        $shippedOrders = \App\Models\Order::where('status', 'shipped')->count();
        $deliveredOrders = \App\Models\Order::where('status', 'delivered')->count();
        $cancelledOrders = \App\Models\Order::where('status', 'cancelled')->count();

        return view('order.index', compact('orders' ,
            'newOrders',
            'processingOrders',
            'shippedOrders',
            'deliveredOrders',
            'cancelledOrders'));
    }

    public function show(Order $order)
    {
        $order->load(['items' => function ($query) {
            $query->where('quantity', '>', 0)->with('product');
        }]);

        return view('order.show', compact('order'));
    }


    public function edit(Order $order)
    {
        return view('order.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:new,processing,shipped,delivered,cancelled',
            'payment_method' => 'required|string'
        ]);

        $order->update($request->only(['status', 'payment_method']));
        return redirect()->route('admin1.orders.index')->with('success', 'Order updated successfully.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin1.orders.index')->with('success', 'Order deleted successfully.');
    }
}
