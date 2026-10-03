<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        // 1. CREATE CATEGORIES
        $categories = [
            'Boodle Fights',
            'Mini Boodle',
            'Pork',
            'Chicken',
            'Seafood',
            'Vegetable',
            'Bilao & Platters',
            'Noodles & Drinks',
            'Silog',
            'Baon Meals',
        ];

        foreach ($categories as $category) {
            DB::table('categories')->updateOrInsert(
                ['slug' => Str::slug($category)],
                [
                    'name' => $category,
                    'is_active' => true,
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }

        $categoryIds = DB::table('categories')->pluck('id', 'name')->all();

        // 2. CREATE PRODUCTS / MENU ITEMS
        $products = [
            // --- BOODLE FIGHTS ---
            ['category' => 'Boodle Fights', 'name' => 'Big Boss Boodle (12 pax)', 'price' => 3749.00],
            ['category' => 'Boodle Fights', 'name' => 'Pigout Boodle (6 pax)', 'price' => 1699.00],
            ['category' => 'Boodle Fights', 'name' => 'Small Boodle (6 pax)', 'price' => 1699.00],
            ['category' => 'Boodle Fights', 'name' => 'Big Boodle (10 pax)', 'price' => 2499.00],
            ['category' => 'Boodle Fights', 'name' => 'Boodle Feast (12 pax)', 'price' => 3399.00],

            // --- MINI BOODLE (3 pax) ---
            ['category' => 'Mini Boodle', 'name' => 'Mini A (Lechon Kawali & Shrimp)', 'price' => 899.00],
            ['category' => 'Mini Boodle', 'name' => 'Mini B (Liempo & Leche Flan)', 'price' => 899.00],
            ['category' => 'Mini Boodle', 'name' => 'Mini C (Crispy Sinigang & Bangus)', 'price' => 899.00],
            ['category' => 'Mini Boodle', 'name' => 'Mini D (Lechon Kawali & Sinigang Bangus)', 'price' => 899.00],
            ['category' => 'Mini Boodle', 'name' => 'Mini E (15pcs BBQ & Shrimp)', 'price' => 899.00],

            // --- PORK ---
            ['category' => 'Pork', 'name' => 'Crispy Ulo (Large)', 'price' => 1050.00],
            ['category' => 'Pork', 'name' => 'Crispy Ulo (Jumbo)', 'price' => 1200.00],
            ['category' => 'Pork', 'name' => 'Crispy Pata (Medium)', 'price' => 799.00],
            ['category' => 'Pork', 'name' => 'Crispy Pata (Large)', 'price' => 899.00],
            ['category' => 'Pork', 'name' => 'Crispy Pata (Jumbo)', 'price' => 999.00],
            ['category' => 'Pork', 'name' => 'Grilled Liempo (6pcs)', 'price' => 449.00],
            ['category' => 'Pork', 'name' => 'Grilled Liempo (8pcs)', 'price' => 549.00],
            ['category' => 'Pork', 'name' => 'Fried Liempo (6pcs)', 'price' => 449.00],
            ['category' => 'Pork', 'name' => 'Fried Liempo (8pcs)', 'price' => 549.00],
            ['category' => 'Pork', 'name' => 'Lechon Kawali (Half)', 'price' => 429.00],
            ['category' => 'Pork', 'name' => 'Lechon Kawali (Whole)', 'price' => 729.00],
            ['category' => 'Pork', 'name' => 'Pork Binagoongan', 'price' => 499.00],
            ['category' => 'Pork', 'name' => 'Sweet and Sour Pork', 'price' => 489.00],
            ['category' => 'Pork', 'name' => 'Crispy Kare-Kare', 'price' => 589.00],
            ['category' => 'Pork', 'name' => 'Crispy Sinigang', 'price' => 529.00],
            ['category' => 'Pork', 'name' => 'Sizzling Crispy Sinigang', 'price' => 479.00],
            ['category' => 'Pork', 'name' => 'Sizzling Sisig', 'price' => 299.00],
            ['category' => 'Pork', 'name' => 'Crispy Chops', 'price' => 289.00],
            ['category' => 'Pork', 'name' => 'Tokwa\'t Baboy', 'price' => 199.00],

            // --- CHICKEN ---
            ['category' => 'Chicken', 'name' => 'Whole Chicken & Kamote', 'price' => 400.00],
            ['category' => 'Chicken', 'name' => 'Spicy Chicken', 'price' => 290.00],
            ['category' => 'Chicken', 'name' => 'Creamy Chicken', 'price' => 290.00],
            ['category' => 'Chicken', 'name' => 'Adobo Wings', 'price' => 349.00],
            ['category' => 'Chicken', 'name' => 'Grilled Wings', 'price' => 349.00],
            ['category' => 'Chicken', 'name' => 'Fried Wings', 'price' => 349.00],

            // --- SEAFOOD ---
            ['category' => 'Seafood', 'name' => 'Buttered Shrimp', 'price' => 309.00],
            ['category' => 'Seafood', 'name' => 'Sinigang na Hipon', 'price' => 230.00],
            ['category' => 'Seafood', 'name' => 'Pakbet na Hipon', 'price' => 400.00],
            ['category' => 'Seafood', 'name' => 'Grilled Pampano', 'price' => 900.00],
            ['category' => 'Seafood', 'name' => 'Bistek na Bangus Belly', 'price' => 450.00],
            ['category' => 'Seafood', 'name' => 'Sinigang na Bangus Belly', 'price' => 480.00],
            ['category' => 'Seafood', 'name' => 'Sweet and Sour Fish', 'price' => 349.00],
            ['category' => 'Seafood', 'name' => 'Fish and Chips', 'price' => 249.00],
            ['category' => 'Seafood', 'name' => 'Fried Bangus Daing w/ Egg & Tomato', 'price' => 218.00],

            // --- VEGETABLE ---
            ['category' => 'Vegetable', 'name' => 'Chopsuey', 'price' => 349.00],
            ['category' => 'Vegetable', 'name' => 'Omelette', 'price' => 229.00],

            // --- BILAO & PLATTERS ---
            ['category' => 'Bilao & Platters', 'name' => 'Sama-Sama Bilao (Pancit, Shanghai, BBQ)', 'price' => 1589.00],
            ['category' => 'Bilao & Platters', 'name' => 'Special Pancit Bilao (Big)', 'price' => 1150.00],
            ['category' => 'Bilao & Platters', 'name' => 'Special Pancit Bilao (Small)', 'price' => 600.00],
            ['category' => 'Bilao & Platters', 'name' => 'BBQ and Shanghai Bilao', 'price' => 1079.00],
            ['category' => 'Bilao & Platters', 'name' => 'BBQ Platter (15 pcs)', 'price' => 375.00],
            ['category' => 'Bilao & Platters', 'name' => 'Shanghai Platter (30 pcs)', 'price' => 300.00],

            // --- NOODLES & DRINKS ---
            ['category' => 'Noodles & Drinks', 'name' => 'Sweet & Spicy Canton', 'price' => 150.00],
            ['category' => 'Noodles & Drinks', 'name' => 'Original Canton', 'price' => 150.00],
            ['category' => 'Noodles & Drinks', 'name' => 'Bihon', 'price' => 130.00],
            ['category' => 'Noodles & Drinks', 'name' => 'Sotanghon (Guisado or Soup)', 'price' => 130.00],
            ['category' => 'Noodles & Drinks', 'name' => 'Plain Rice', 'price' => 25.00],
            ['category' => 'Noodles & Drinks', 'name' => 'Leche Flan', 'price' => 110.00],
            ['category' => 'Noodles & Drinks', 'name' => 'Coke/Royal/Sprite (1.5L)', 'price' => 120.00],
            ['category' => 'Noodles & Drinks', 'name' => 'Lemonade Glass/Pitcher', 'price' => 35.00],

            // --- SILOG ---
            ['category' => 'Silog', 'name' => 'Pork Silog', 'price' => 149.00],
            ['category' => 'Silog', 'name' => 'Tapsilog', 'price' => 149.00],
            ['category' => 'Silog', 'name' => 'Tocilog', 'price' => 149.00],

            // --- BAON MEALS ---
            ['category' => 'Baon Meals', 'name' => 'Liempo Baon', 'price' => 148.00],
            ['category' => 'Baon Meals', 'name' => 'Sweet & Sour Fish Pops', 'price' => 99.00],
            ['category' => 'Baon Meals', 'name' => 'Shanghai Baon', 'price' => 99.00],
            ['category' => 'Baon Meals', 'name' => 'Creamy Chicken Baon', 'price' => 99.00],
            ['category' => 'Baon Meals', 'name' => 'Spicy Chicken Baon', 'price' => 99.00],
            ['category' => 'Baon Meals', 'name' => 'Pancit Bihon & Shanghai', 'price' => 99.00],
            ['category' => 'Baon Meals', 'name' => 'Pancit Canton & Shanghai', 'price' => 99.00],
        ];

        foreach ($products as $product) {
            DB::table('products')->updateOrInsert(
                ['sku' => 'BBB-'.strtoupper(substr(sha1(Str::slug($product['category']).'|'.$product['name']), 0, 12))],
                [
                    'category_id' => $categoryIds[$product['category']],
                    'name' => $product['name'],
                    'sku' => 'BBB-'.strtoupper(substr(sha1(Str::slug($product['category']).'|'.$product['name']), 0, 12)),
                    'price' => $product['price'],
                    'is_available' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
