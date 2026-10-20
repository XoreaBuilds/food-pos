<div class="p-6" wire:poll.10s>
    <p class="text-sm font-semibold uppercase tracking-wide text-emerald-700">{{ $isKitchenDisplay ? 'Kitchen workspace' : 'Cashier workspace' }}</p>
    <h1 class="mt-1 text-2xl font-bold mb-6">{{ $isKitchenDisplay ? 'Kitchen Display' : 'Order Status' }}</h1>

    <h2 class="text-lg font-semibold mb-3">{{ $isKitchenDisplay ? 'Incoming orders' : 'Open Tickets (Not Yet Paid)' }}</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
        @forelse($openOrders as $order)
            <div class="bg-white border rounded-lg p-4">
                <p class="font-semibold mb-1">{{ $order->ticket_number }}</p>
                <ul class="text-sm text-gray-600 mb-2">
                    @foreach($order->items as $item)
                        <li>{{ $item->qty }}x {{ $item->product->name }}</li>
                    @endforeach
                </ul>
                <p class="text-xs text-gray-400">{{ $order->created_at->diffForHumans() }}</p>
                <span class="inline-block mt-2 text-xs px-2 py-1 rounded-full bg-amber-100 text-amber-700">Open</span>
            </div>
        @empty
            <p class="text-gray-400 text-sm">No open tickets right now.</p>
        @endforelse
    </div>

    @unless($isKitchenDisplay)
    <h2 class="text-lg font-semibold mb-3">Recently Paid (Today)</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($paidOrders as $order)
            <div class="bg-white border rounded-lg p-4">
                <p class="font-semibold mb-1">{{ $order->ticket_number }}</p>
                <p class="text-sm text-gray-600">₱{{ number_format($order->total, 2) }}</p>
                <p class="text-xs text-gray-400">{{ $order->created_at->diffForHumans() }}</p>
                <span class="inline-block mt-2 text-xs px-2 py-1 rounded-full bg-green-100 text-green-700">Paid</span>
            </div>
        @empty
            <p class="text-gray-400 text-sm">No paid orders yet today.</p>
        @endforelse
    </div>
    @endunless
</div>
