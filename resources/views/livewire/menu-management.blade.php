<div class="min-h-screen bg-slate-50 p-4 sm:p-6 lg:p-8">
    <div class="mx-auto max-w-7xl space-y-6">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wider text-emerald-700">Restaurant setup</p>
                <h1 class="mt-1 text-3xl font-bold text-slate-900">Menu management</h1>
                <p class="mt-1 text-slate-600">Keep categories, prices, options, and availability up to date.</p>
            </div>
            <div class="rounded-xl bg-white px-4 py-3 text-sm text-slate-600 shadow-sm ring-1 ring-slate-200">
                <span class="font-semibold text-slate-900">{{ $products->count() }}</span> menu items
                <span class="mx-2 text-slate-300">|</span>
                <span class="font-semibold text-slate-900">{{ $categories->count() }}</span> categories
            </div>
        </div>

        @if (session()->has('menu-message'))
            <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">{{ session('menu-message') }}</div>
        @endif

        <section class="grid gap-6 xl:grid-cols-[0.8fr_1.2fr]">
            <div class="space-y-6">
                <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
                    <h2 class="text-lg font-bold text-slate-900">Categories</h2>
                    <p class="mb-4 text-sm text-slate-500">Use short names staff can scan quickly at the register.</p>
                    <form wire:submit="saveCategory" class="flex gap-2">
                        <input wire:model="categoryName" type="text" placeholder="e.g. Seafood" class="min-w-0 flex-1 rounded-lg border-slate-300 text-sm focus:border-emerald-500 focus:ring-emerald-500">
                        <button class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-700">{{ $editingCategoryId ? 'Save' : 'Add' }}</button>
                    </form>
                    @error('categoryName') <p class="mt-2 text-sm text-rose-600">{{ $message }}</p> @enderror
                    <div class="mt-4 divide-y divide-slate-100">
                        @forelse($categories as $category)
                            <div class="flex items-center justify-between gap-3 py-3">
                                <div class="min-w-0">
                                    <p class="truncate text-sm font-semibold text-slate-900">{{ $category->name }}</p>
                                    <p class="text-xs text-slate-500">{{ $category->products_count }} items · {{ $category->is_active ? 'Active' : 'Hidden' }}</p>
                                </div>
                                <div class="flex shrink-0 gap-2">
                                    <button wire:click="editCategory({{ $category->id }})" class="text-xs font-semibold text-emerald-700 hover:text-emerald-900">Rename</button>
                                    <button wire:click="toggleCategory({{ $category->id }})" class="text-xs font-semibold text-slate-500 hover:text-slate-800">{{ $category->is_active ? 'Hide' : 'Show' }}</button>
                                </div>
                            </div>
                        @empty
                            <p class="py-4 text-sm text-slate-500">No categories yet. Add one to organize your menu.</p>
                        @endforelse
                    </div>
                </div>

                <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
                    <div class="mb-4 flex items-start justify-between gap-3">
                        <div>
                            <h2 class="text-lg font-bold text-slate-900">{{ $editingProductId ? 'Edit menu item' : 'Add menu item' }}</h2>
                            <p class="text-sm text-slate-500">Use one consistent name and a clear base price.</p>
                        </div>
                        @if($editingProductId)<button wire:click="resetProductForm" class="text-sm font-semibold text-slate-500 hover:text-slate-900">Cancel</button>@endif
                    </div>
                    <form wire:submit="saveProduct" class="space-y-4">
                        <div class="grid gap-4 sm:grid-cols-2">
                            <label class="block text-sm font-medium text-slate-700">Item name
                                <input wire:model="productName" type="text" placeholder="e.g. Crispy Pata" class="mt-1 w-full rounded-lg border-slate-300 text-sm">
                                @error('productName')<span class="text-xs text-rose-600">{{ $message }}</span>@enderror
                            </label>
                            <label class="block text-sm font-medium text-slate-700">SKU / item code
                                <input wire:model="productSku" type="text" placeholder="e.g. PORK-001" class="mt-1 w-full rounded-lg border-slate-300 text-sm uppercase">
                                @error('productSku')<span class="text-xs text-rose-600">{{ $message }}</span>@enderror
                            </label>
                        </div>
                        <div class="grid gap-4 sm:grid-cols-2">
                            <label class="block text-sm font-medium text-slate-700">Category
                                <select wire:model="productCategoryId" class="mt-1 w-full rounded-lg border-slate-300 text-sm">
                                    <option value="">Choose category</option>
                                    @foreach($categories as $category)<option value="{{ $category->id }}">{{ $category->name }}</option>@endforeach
                                </select>
                                @error('productCategoryId')<span class="text-xs text-rose-600">{{ $message }}</span>@enderror
                            </label>
                            <div class="grid grid-cols-2 gap-3">
                                <label class="block text-sm font-medium text-slate-700">Base price
                                    <input wire:model="productPrice" type="number" min="0" step="0.01" placeholder="0.00" class="mt-1 w-full rounded-lg border-slate-300 text-sm">
                                    @error('productPrice')<span class="text-xs text-rose-600">{{ $message }}</span>@enderror
                                </label>
                                <label class="block text-sm font-medium text-slate-700">Item type
                                    <select wire:model="productType" class="mt-1 w-full rounded-lg border-slate-300 text-sm">
                                        <option value="standard">Standard</option><option value="combo">Combo / meal</option>
                                    </select>
                                </label>
                            </div>
                        </div>
                        <label class="block text-sm font-medium text-slate-700">Description <span class="font-normal text-slate-400">(optional)</span>
                            <textarea wire:model="productDescription" rows="2" placeholder="What is included? Add useful details for staff." class="mt-1 w-full rounded-lg border-slate-300 text-sm"></textarea>
                            @error('productDescription')<span class="text-xs text-rose-600">{{ $message }}</span>@enderror
                        </label>
                        <div class="rounded-xl bg-slate-50 p-4">
                            <div class="mb-3 flex items-center justify-between">
                                <div><p class="text-sm font-semibold text-slate-800">Sizes and prices</p><p class="text-xs text-slate-500">For example: Small, Medium, Large.</p></div>
                                <button type="button" wire:click="addVariant" class="rounded-lg border border-slate-300 bg-white px-3 py-1.5 text-xs font-semibold text-slate-700 hover:bg-slate-100">Add size</button>
                            </div>
                            @foreach($variants as $index => $variant)
                                <div wire:key="variant-{{ $index }}" class="mb-2 flex gap-2">
                                    <input wire:model="variants.{{ $index }}.name" type="text" placeholder="Size name" class="min-w-0 flex-1 rounded-lg border-slate-300 text-sm">
                                    <input wire:model="variants.{{ $index }}.price" type="number" min="0" step="0.01" placeholder="Price" class="w-28 rounded-lg border-slate-300 text-sm">
                                    <button type="button" wire:click="removeVariant({{ $index }})" class="px-2 text-slate-400 hover:text-rose-600" aria-label="Remove size">×</button>
                                </div>
                            @endforeach
                            @error('variants')<p class="text-xs text-rose-600">{{ $message }}</p>@enderror
                        </div>
                        <label class="block text-sm font-medium text-slate-700">Add-ons <span class="font-normal text-slate-400">(one per line: name | extra price)</span>
                            <textarea wire:model="addonsText" rows="3" placeholder="Extra rice | 25&#10;Extra sauce | 15" class="mt-1 w-full rounded-lg border-slate-300 text-sm"></textarea>
                            @error('addonsText')<span class="text-xs text-rose-600">{{ $message }}</span>@enderror
                        </label>
                        <label class="flex items-center gap-2 text-sm font-medium text-slate-700"><input wire:model="productAvailable" type="checkbox" class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500"> Available for ordering</label>
                        <button class="w-full rounded-lg bg-emerald-600 px-4 py-3 text-sm font-bold text-white hover:bg-emerald-700">{{ $editingProductId ? 'Save changes' : 'Add menu item' }}</button>
                    </form>
                </div>
            </div>

            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200">
                <div class="border-b border-slate-200 p-5">
                    <h2 class="text-lg font-bold text-slate-900">Menu items</h2>
                    <p class="text-sm text-slate-500">Turn items off when sold out; they will no longer appear at the register.</p>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[680px] text-left text-sm">
                        <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500"><tr><th class="px-5 py-3">Item</th><th class="px-4 py-3">Category</th><th class="px-4 py-3">Price</th><th class="px-4 py-3">Availability</th><th class="px-5 py-3"></th></tr></thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($products as $product)
                                <tr class="align-top hover:bg-slate-50/70">
                                    <td class="px-5 py-4"><p class="font-semibold text-slate-900">{{ $product->name }}</p><p class="mt-0.5 text-xs text-slate-500">{{ $product->sku }} · {{ $product->type === 'combo' ? 'Combo' : 'Standard' }}</p>
                                        @if($product->variants->isNotEmpty() || $product->addons->isNotEmpty())<div class="mt-2 flex flex-wrap gap-1">@if($product->variants->isNotEmpty())<span class="rounded bg-blue-50 px-2 py-0.5 text-xs text-blue-700">{{ $product->variants->count() }} sizes</span>@endif @if($product->addons->isNotEmpty())<span class="rounded bg-violet-50 px-2 py-0.5 text-xs text-violet-700">{{ $product->addons->count() }} add-ons</span>@endif</div>@endif
                                    </td>
                                    <td class="px-4 py-4 text-slate-600">{{ $product->category?->name ?? 'Uncategorized' }}</td>
                                    <td class="px-4 py-4 font-semibold text-slate-900">₱{{ number_format($product->price, 2) }}</td>
                                    <td class="px-4 py-4"><button wire:click="toggleAvailability({{ $product->id }})" class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $product->is_available ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">{{ $product->is_available ? 'Available' : 'Sold out' }}</button></td>
                                    <td class="px-5 py-4 text-right"><button wire:click="editProduct({{ $product->id }})" class="font-semibold text-emerald-700 hover:text-emerald-900">Edit</button></td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="px-5 py-12 text-center text-slate-500">No menu items yet. Add your first item using the form.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>
