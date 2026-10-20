<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PosRegister extends Component
{
    public string $activeCategory = 'All';
    public array $cart = [];
    public float $taxRate = 0.0843;

    public function mount()
    {
        $this->cart = session('pos_cart', []);
    }

    public function getCategoriesProperty()
    {
        return Category::where('is_active', true)->orderBy('sort_order')->orderBy('name')->pluck('name')->prepend('All');
    }

    public function getProductsProperty()
    {
        return Product::query()
            ->where('is_available', true)
            ->whereHas('category', fn($category) => $category->where('is_active', true))
            ->when($this->activeCategory !== 'All', function ($q) {
                $q->whereHas('category', fn($c) => $c->where('name', $this->activeCategory));
            })
            ->orderBy('name')
            ->get();
    }

    public function setCategory(string $category)
    {
        $this->activeCategory = $category;
    }

    public function addToCart(int $productId)
    {
        $product = Product::where('is_available', true)->findOrFail($productId);

        if (isset($this->cart[$productId])) {
            $this->cart[$productId]['qty']++;
        } else {
            $this->cart[$productId] = [
                'name' => $product->name,
                'price' => (float) $product->price,
                'qty' => 1,
                'notes' => [],
            ];
        }

        session(['pos_cart' => $this->cart]);
    }

    public function getSubtotalProperty(): float
    {
        return collect($this->cart)->sum(fn($item) => $item['price'] * $item['qty']);
    }

    public function getTaxProperty(): float
    {
        return round($this->subtotal * $this->taxRate, 2);
    }

    public function getTotalProperty(): float
    {
        return round($this->subtotal + $this->tax, 2);
    }

    public function render()
    {
        return view('livewire.pos-register', [
            'categories' => $this->categories,
            'products' => $this->products,
        ])->layout('layouts.app');
    }
}
