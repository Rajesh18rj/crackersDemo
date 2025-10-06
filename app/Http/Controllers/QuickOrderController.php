<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class QuickOrderController extends Controller
{
    public function index()
    {
        $categories = Category::with(['products' => function ($query) {
            $query->where('is_active', true);
        }])->get();

        return view('quick-order', compact('categories'));
    }


    public function checkout(Request $request)
    {
        $cart = $request->input('cart', []);

        // decode if sent as JSON string
        if (is_string($cart)) {
            $cart = json_decode($cart, true);
        }

        // safety check: ensure each item is array
        $cart = array_filter($cart, fn($item) => is_array($item) && isset($item['price'], $item['quantity']));

        $totalAmount = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        if ($totalAmount < 5000) {
            return redirect()->back()->with('error', 'Minimum order is ₹3000');
        }

        session()->put('cart', $cart);
        return redirect()->route('checkout.show');
    }

}
