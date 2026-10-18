<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Reports</h1>

    <div class="grid grid-cols-2 gap-4 mb-6">
        <div class="bg-white border rounded-lg p-4">
            <p class="text-sm text-gray-500">Today's Sales</p>
            <p class="text-2xl font-bold">₱{{ number_format($totalSales, 2) }}</p>
        </div>
        <div class="bg-white border rounded-lg p-4">
            <p class="text-sm text-gray-500">Orders Today</p>
            <p class="text-2xl font-bold">{{ $orderCount }}</p>
        </div>
    </div>

    <h2 class="text-lg font-semibold mb-2">Top Products Today</h2>
    <ul>
        @forelse($topProducts as $item)
            <li>{{ $item->product->name ?? 'Unknown' }} — {{ $item->total_qty }} sold</li>
        @empty
            <li class="text-gray-400">No sales yet today.</li>
        @endforelse
    </ul>
</div>