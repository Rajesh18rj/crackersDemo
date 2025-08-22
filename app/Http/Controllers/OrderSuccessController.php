<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderSuccessController extends Controller
{
    public function success(Order $order)
    {
        // Load order with items and product details
        $order->load('items.product');

        return view('checkout-success', compact('order'));
    }
}
