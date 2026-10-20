<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class MenuManagement extends Component
{
    public ?int $editingCategoryId = null;
    public string $categoryName = '';
    public ?int $editingProductId = null;
    public string $productName = '';
    public string $productSku = '';
    public string $productDescription = '';
    public string $productType = 'standard';
    public string $productPrice = '';
    public ?int $productCategoryId = null;
    public bool $productAvailable = true;
    public array $variants = [];
    public string $addonsText = '';

    protected function rules(): array
    {
        return [
            'categoryName' => ['required', 'string', 'max:100', Rule::unique('categories', 'name')->ignore($this->editingCategoryId)],
            'productName' => ['required', 'string', 'max:150'],
            'productSku' => ['required', 'string', 'max:32', Rule::unique('products', 'sku')->ignore($this->editingProductId)],
            'productDescription' => ['nullable', 'string', 'max:1000'],
            'productType' => ['required', Rule::in(['standard', 'combo'])],
            'productPrice' => ['required', 'numeric', 'min:0', 'max:99999999.99'],
            'productCategoryId' => ['required', 'exists:categories,id'],
            'productAvailable' => ['boolean'],
            'variants' => ['array'],
            'variants.*.name' => ['nullable', 'string', 'max:80'],
            'variants.*.price' => ['nullable', 'numeric', 'min:0', 'max:99999999.99'],
            'addonsText' => ['nullable', 'string', 'max:3000'],
        ];
    }

    public function saveCategory(): void
    {
        $this->validateOnly('categoryName');
        $category = $this->editingCategoryId ? Category::findOrFail($this->editingCategoryId) : new Category();
        $category->name = trim($this->categoryName);
        $category->slug = Str::slug($this->categoryName);
        $category->save();
        $this->reset('editingCategoryId', 'categoryName');
        session()->flash('menu-message', 'Category saved.');
    }

    public function editCategory(int $id): void
    {
        $category = Category::findOrFail($id);
        $this->editingCategoryId = $category->id;
        $this->categoryName = $category->name;
    }

    public function toggleCategory(int $id): void
    {
        $category = Category::findOrFail($id);
        $category->is_active = !$category->is_active;
        $category->save();
    }

    public function saveProduct(): void
    {
        $this->validate();
        $variants = collect($this->variants)
            ->filter(fn($variant) => filled($variant['name'] ?? null) || filled($variant['price'] ?? null))
            ->values();
        foreach ($variants as $variant) {
            if (!filled($variant['name'] ?? null) || !is_numeric($variant['price'] ?? null)) {
                $this->addError('variants', 'Enter both a size name and price for every size.');
                return;
            }
        }

        $addons = [];
        foreach (preg_split('/\r\n|\r|\n/', $this->addonsText) as $line) {
            $line = trim($line);
            if ($line === '') {
                continue;
            }
            [$name, $price] = array_pad(array_map('trim', explode('|', $line, 2)), 2, '0');
            if ($name === '' || !is_numeric($price) || (float) $price < 0) {
                $this->addError('addonsText', 'Add-ons must use the format “Name | price”, for example “Extra rice | 25”.');
                return;
            }
            $addons[] = ['name' => $name, 'price' => $price];
        }

        DB::transaction(function () use ($variants, $addons) {
            $product = $this->editingProductId ? Product::findOrFail($this->editingProductId) : new Product();
            $product->fill([
                'category_id' => $this->productCategoryId,
                'name' => trim($this->productName),
                'sku' => strtoupper(trim($this->productSku)),
                'description' => trim($this->productDescription) ?: null,
                'type' => $this->productType,
                'price' => $this->productPrice,
                'is_available' => $this->productAvailable,
            ]);
            $product->save();

            $product->variants()->delete();
            foreach ($variants as $variant) {
                $product->variants()->create(['name' => trim($variant['name']), 'price' => $variant['price']]);
            }
            $product->addons()->delete();
            foreach ($addons as $addon) {
                $product->addons()->create($addon);
            }
        });

        $this->resetProductForm();
        session()->flash('menu-message', 'Menu item saved.');
    }

    public function editProduct(int $id): void
    {
        $product = Product::with(['variants', 'addons'])->findOrFail($id);
        $this->editingProductId = $product->id;
        $this->productName = $product->name;
        $this->productSku = $product->sku;
        $this->productDescription = $product->description ?? '';
        $this->productType = $product->type ?? 'standard';
        $this->productPrice = (string) $product->price;
        $this->productCategoryId = $product->category_id;
        $this->productAvailable = $product->is_available;
        $this->variants = $product->variants->map(fn($variant) => ['name' => $variant->name, 'price' => (string) $variant->price])->all();
        $this->addonsText = $product->addons->map(fn($addon) => $addon->name . ' | ' . number_format($addon->price, 2, '.', ''))->implode("\n");
    }

    public function toggleAvailability(int $id): void
    {
        $product = Product::findOrFail($id);
        $product->is_available = !$product->is_available;
        $product->save();
    }

    public function addVariant(): void
    {
        $this->variants[] = ['name' => '', 'price' => ''];
    }

    public function removeVariant(int $index): void
    {
        unset($this->variants[$index]);
        $this->variants = array_values($this->variants);
    }

    public function resetProductForm(): void
    {
        $this->reset('editingProductId', 'productName', 'productSku', 'productDescription', 'productType', 'productPrice', 'productCategoryId', 'productAvailable', 'variants', 'addonsText');
        $this->productType = 'standard';
        $this->productAvailable = true;
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.menu-management', [
            'categories' => Category::withCount('products')->orderBy('sort_order')->orderBy('name')->get(),
            'products' => Product::with(['category', 'variants', 'addons'])->orderBy('name')->get(),
        ])->layout('layouts.app');
    }
}
