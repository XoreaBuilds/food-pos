<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class ReportsPage extends Component
{
    public function render()
    {
        $todayOrders = Order::whereDate('created_at', today())
            ->where('status', 'paid')
            ->get();

        $totalSales = $todayOrders->sum('total');
        $orderCount = $todayOrders->count();

        $topProducts = \App\Models\OrderItem::selectRaw('product_id, SUM(qty) as total_qty')
            ->whereHas('order', fn($q) => $q->whereDate('created_at', today())->where('status', 'paid'))
            ->groupBy('product_id')
            ->orderByDesc('total_qty')
            ->with('product')
            ->limit(5)
            ->get();

        return view('livewire.reports-page', [
            'totalSales' => $totalSales,
            'orderCount' => $orderCount,
            'topProducts' => $topProducts,
        ]);
    }
}
