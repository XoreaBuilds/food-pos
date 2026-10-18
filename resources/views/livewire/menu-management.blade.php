<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Menu Management</h1>

    <h2 class="text-lg font-semibold mt-4 mb-2">Categories</h2>
    <ul>
        @forelse(($categories ?? []) as $category)
            <li>{{ $category->name }}</li>
        @empty
            <li class="text-gray-500">No categories found.</li>
        @endforelse
    </ul>

    <h2 class="text-lg font-semibold mt-6 mb-2">Products</h2>
    <ul>
        @forelse(($products ?? []) as $product)
            <li>{{ $product->name }} - ₱{{ number_format($product->price, 2) }} ({{ $product->category->name }})</li>
        @empty
            <li class="text-gray-500">No products found.</li>
        @endforelse
    </ul>
</div>
