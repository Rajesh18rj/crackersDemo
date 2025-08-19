<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class QuickPurchase extends Component
{
    public $categories;
    public $quantities = [];
    public $totalProducts = 0;
    public $totalAmount = 0;
    public $totalSavings = 0;

    public function mount()
    {
        $this->categories = Category::with('products')->get();

        foreach ($this->categories as $category) {
            foreach ($category->products as $product) {
                $this->quantities[$product->id] = 0;
            }
        }
    }

    public function increment($productId)
    {
        $this->quantities[$productId]++;
        $this->calculateTotals();
    }

    public function decrement($productId)
    {
        if ($this->quantities[$productId] > 0) {
            $this->quantities[$productId]--;
            $this->calculateTotals();
        }
    }

    public function calculateTotals()
    {
        $this->totalProducts = 0;
        $this->totalAmount = 0;
        $this->totalSavings = 0;

        foreach ($this->categories as $category) {
            foreach ($category->products as $product) {
                $qty = $this->quantities[$product->id];
                if ($qty > 0) {
                    $this->totalProducts += $qty;
                    $this->totalAmount += $qty * $product->price;
                    $this->totalSavings += $qty * ($product->original_price - $product->price);
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.quick-purchase');
    }
}
