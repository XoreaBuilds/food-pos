<div class="p-6">
    <h1 class="text-3xl font-bold mb-6">POS Register</h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Left: Menu Items --}}
        <div class="lg:col-span-2">
            {{-- Categories --}}
            <div class="mb-4">
                <h2 class="text-lg font-semibold mb-2">Categories</h2>
                <div class="flex flex-wrap gap-2">
                    @foreach($categories as $category)
                        <button wire:click="setCategory('{{ $category }}')"
                            class="px-4 py-2 rounded-lg border transition-colors text-sm font-medium
                                            {{ $activeCategory === $category ? 'bg-green-600 text-white border-green-600' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50' }}">
                            {{ $category }}
                        </button>
                    @endforeach
                </div>
            </div>

            {{-- Products --}}
            <div>
                <h2 class="text-lg font-semibold mb-2">Menu Items</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($products as $product)
                        <button wire:click="addToCart({{ $product->id }})"
                            class="bg-white border rounded-lg p-4 text-left hover:border-green-500 transition-colors">
                            <h3 class="font-semibold text-gray-900">{{ $product->name }}</h3>
                            <p class="text-sm text-gray-500 mt-1">₱{{ number_format($product->price, 2) }}</p>
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Right: Cart & Checkout --}}
        <div class="lg:col-span-1">
            <div class="bg-white border rounded-lg p-4 shadow">
                <h2 class="text-xl font-semibold mb-4">Cart</h2>

                {{-- Cart Items --}}
                <div class="space-y-3 mb-6">
                    @foreach($cart as $id => $item)
                        <div class="border rounded-lg p-3">
                            <div class="flex justify-between mb-1">
                                <span class="font-medium">{{ $item['name'] }}</span>
                                <span class="text-gray-500">₱{{ number_format($item['price'] * $item['qty'], 2) }}</span>
                            </div>
                            <div class="text-sm text-gray-500">
                                {{ $item['qty'] }}x at ₱{{ number_format($item['price'], 2) }}
                            </div>
                        </div>
                    @endforeach

                    @if(empty($cart))
                        <p class="text-gray-400 text-center py-4">Cart is empty</p>
                    @endif
                </div>

                {{-- Totals --}}
                <div class="space-y-2 mb-6">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Subtotal</span>
                        <span>₱{{ number_format($this->subtotal, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Tax ({{ ($taxRate * 100) }}%)</span>
                        <span>₱{{ number_format($this->tax, 2) }}</span>
                    </div>
                    <div class="flex justify-between font-bold text-lg pt-2 border-t mt-2">
                        <span>Total</span>
                        <span>₱{{ number_format($this->total, 2) }}</span>
                    </div>
                </div>

                {{-- Checkout Button --}}
                @if(!empty($cart))
                    <a href="{{ route('payment') }}"
                        class="block w-full bg-green-600 text-white py-3 rounded-lg text-center font-semibold hover:bg-green-700 transition-colors">
                        Proceed to Payment
                    </a>
                @else
                    <button disabled
                        class="w-full bg-gray-300 text-gray-600 py-3 rounded-lg text-center font-semibold cursor-not-allowed">
                        Add Items First
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>
