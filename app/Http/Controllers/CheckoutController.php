<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmedMail;
use App\Mail\OrderReceivedMail;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function show()
    {
        $cart = session()->get('cart', []);
        $totals = $this->calculateTotals($cart);

        return view('checkout-page-new', [
            'cart'      => $cart,
            'subtotal'  => $totals['subtotal'],
            'shipping'  => $totals['shipping'],
            'packing'   => $totals['packing'],
            'total'     => $totals['total'],
        ]);
    }

    public function placeOrder(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return back()->withErrors(['cart' => 'Your Cart is Empty.'])->withInput();
        }

        $validated = $request->validate([
            'first_name'     => 'required|string|max:255',
            'last_name'      => 'nullable|string|max:255',
            'email'          => 'nullable|email',
            'phone'          => 'required|string|max:15',
            'street_address' => 'required|string',
            'city'           => 'required|string',
            'state'          => 'required|string',
            'pincode'        => 'required|string|max:10',
            'agree'          => 'accepted',
            'notes'          => 'nullable|string',
        ], [
            'first_name.required' => 'First name is required.',
            'phone.required'      => 'Phone number is required.',
            'street_address.required' => 'Street address is required.',
            'city.required'       => 'City is required.',
            'state.required'      => 'State is required.',
            'pincode.required'    => 'PIN Code is required.',
            'agree.accepted'      => 'You must agree to the terms and conditions.',
        ]);

        $totals = $this->calculateTotals($cart);

        // Save order
        $order = Order::create([
            'first_name'      => $validated['first_name'],
            'last_name'       => $validated['last_name'] ?? null,
            'email'           => $validated['email'] ?? null,
            'phone'           => $validated['phone'],
            'country'         => 'India',
            'street_address'  => $validated['street_address'],
            'city'            => $validated['city'],
            'state'           => $validated['state'],
            'pincode'         => $validated['pincode'],
            'notes'           => $validated['notes'] ?? null,
            'subtotal'        => $totals['subtotal'],
            'shipping'        => $totals['shipping'],
            'packing_charges' => $totals['packing'],
            'total'           => $totals['total'],
            'payment_method'  => 'bank_transfer',
        ]);

        // Save items
        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $productId,
                'quantity'   => $item['quantity'],
                'price'      => $item['price'],
                'total'      => $item['price'] * $item['quantity'],
            ]);
        }

        // Clear cart
        session()->forget('cart');

        // Send confirmation email if email provided
        if (!empty($order->email)) {
            Mail::to($order->email)->send(new OrderConfirmedMail($order));
        }

        // Send mail to shop owner
        Mail::to('rajeshkumar18rj@gmail.com')->send(new OrderReceivedMail($order));

        return redirect()->route('checkout.success', $order->id)

        ->with('success', 'Order placed successfully!');
    }

    private function calculateTotals($cart)
    {
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $shipping = 0; // Paid by Transport Office
        $packing = round($subtotal * 0.03, 2);
        $total = $subtotal + $shipping + $packing;

        return compact('subtotal', 'shipping', 'packing', 'total');
    }

    public function success($orderId)
    {
        $order = Order::findOrFail($orderId);

        return view('checkout-success', compact('order'));
    }
}
