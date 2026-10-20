<div class="p-6 max-w-lg">
    <h1 class="text-2xl font-bold mb-4">Payment Processing</h1>

    <div class="flex gap-2 mb-4">
        <input wire:model="ticketNumber" type="text" placeholder="Enter ticket number"
            class="flex-1 border rounded px-3 py-2 text-sm">
        <button wire:click="findOrder" class="bg-gray-800 text-white px-4 py-2 rounded text-sm">
            Find
        </button>
    </div>

    @if($message)
        <p class="text-sm text-red-600 mb-4">{{ $message }}</p>
    @endif

    @if($order)
        <div class="bg-white border rounded-lg p-4">
            <p class="font-semibold mb-2">Ticket {{ $order->ticket_number }}</p>
            <ul class="text-sm mb-3">
                @foreach($order->items as $item)
                    <li>{{ $item->qty }}x {{ $item->product->name }} — ₱{{ number_format($item->unit_price * $item->qty, 2) }}
                    </li>
                @endforeach
            </ul>
            <p class="font-bold mb-3">Total: ₱{{ number_format($order->total, 2) }}</p>

            <select wire:model="paymentMethod" class="border rounded px-3 py-2 text-sm mb-3 w-full">
                <option value="cash">Cash</option>
                <option value="card">Card</option>
                <option value="gcash">GCash</option>
            </select>

            <button wire:click="processPayment" class="w-full bg-green-600 text-white py-2 rounded text-sm font-semibold">
                Confirm Payment
            </button>
        </div>
    @endif
</div>