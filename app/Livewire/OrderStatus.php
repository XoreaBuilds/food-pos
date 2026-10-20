<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class OrderStatus extends Component
{
    public function render()
    {
        $isKitchenDisplay = request()->routeIs('kitchen.display');
        $openOrders = Order::where('status', 'open')
            ->with('items.product')
            ->latest()
            ->get();

        $paidOrders = Order::where('status', 'paid')
            ->whereDate('created_at', today())
            ->with('items.product')
            ->latest()
            ->take(10)
            ->get();

        return view('livewire.order-status', [
            'openOrders' => $openOrders,
            'paidOrders' => $isKitchenDisplay ? collect() : $paidOrders,
            'isKitchenDisplay' => $isKitchenDisplay,
        ])->layout('layouts.app');
    }
}
