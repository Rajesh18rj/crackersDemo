<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Component;

class CheckoutPage extends Component
{
    // Cart + totals
    public $cart = [];          // [productId => ['name','price','quantity']]
    public $subtotal = 0;
    public $shipping = 0;
    public $packing_charges = 0;
    public $total = 0;

    // Billing & shipping
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $country = 'India';  // readonly, default value
    public $street_address;
    public $city;
    public $state;
    public $pincode;
    public $notes;
    public $agree = false;      // terms checkbox

    protected $rules = [
        'first_name'      => 'required|string|max:255',
        'last_name'       => 'nullable|string|max:255',
        'email'           => 'nullable|email',
        'phone'           => 'required|string|max:15',
        'street_address'  => 'required|string',
        'city'            => 'required|string',
        'state'           => 'required|string',
        'pincode'         => 'required|string|max:10',
        'agree'           => 'accepted',
    ];

    protected $messages = [
        'first_name.required'     => 'First name is required.',
        'phone.required'          => 'Phone number is required.',
        'street_address.required' => 'Street address is required.',
        'city.required'           => 'City is required.',
        'state.required'          => 'State is required.',
        'pincode.required'        => 'PIN Code is required.',
        'agree.accepted'          => 'You must agree to the terms and conditions.',
    ];

    public function mount()
    {
        // Load cart from session
        $this->cart = session()->get('cart', []);
        $this->recalculate();
    }

    public function recalculate(): void
    {
        $this->subtotal = 0;

        foreach ($this->cart as $item) {
            $this->subtotal += $item['price'] * $item['quantity'];
        }

        $this->shipping = 0; // Paid by Transport Office
        $this->packing_charges = round($this->subtotal * 0.03, 2); // 3%
        $this->total = $this->subtotal + $this->shipping + $this->packing_charges;
    }

    public function placeOrder()
    {
        // Remove debug 'dd'
        $this->validate();

        if (empty($this->cart)) {
            $this->addError('cart', 'Your Cart is Empty.');
            return;
        }

        // Save order
        $order = Order::create([
            'first_name'      => $this->first_name,
            'last_name'       => $this->last_name,
            'email'           => $this->email,
            'phone'           => $this->phone,
            'country'         => $this->country,
            'street_address'  => $this->street_address,
            'city'            => $this->city,
            'state'           => $this->state,
            'pincode'         => $this->pincode,
            'notes'           => $this->notes,
            'subtotal'        => $this->subtotal,
            'shipping'        => $this->shipping,
            'packing_charges' => $this->packing_charges,
            'total'           => $this->total,
            'payment_method'  => 'bank_transfer',
        ]);

        // Save items
        foreach ($this->cart as $productId => $item) {
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

        // Optional: Reset form fields after success
        $this->reset([
            'first_name', 'last_name', 'email', 'phone', 'street_address',
            'city', 'state', 'pincode', 'notes', 'agree',
        ]);
        $this->cart = [];
        $this->subtotal = $this->shipping = $this->packing_charges = $this->total = 0;

        // Flash success message
        session()->flash('success', 'Order placed successfully!');

        // Redirect to success page
        return redirect()->route('checkout-success', ['order' => $order->id]);

    }

    public function hello(){
        dd('hello');
    }

    public function render()
    {
        return view('livewire.checkout-page');
    }
}
