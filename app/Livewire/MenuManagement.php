<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class MenuManagement extends Component
{
    public function render()
    {
        return view('livewire.menu-management', [
            'categories' => Category::all(),
            'products' => Product::with('category')->get(),
        ])->layout('layouts.app');
    }
}