<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a test user if no users exist
        $user = User::first();
        if (!$user) {
            $user = User::create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]);
        }

        // Sample products
        $products = [
            [
                'name' => 'iPhone 15 Pro',
                'price' => 999.99,
                'description' => 'Latest Apple iPhone with Pro features, titanium design, and advanced camera system.',
                'user_id' => $user->id,
            ],
            [
                'name' => 'MacBook Air M2',
                'price' => 1199.00,
                'description' => 'Lightweight laptop with M2 chip, perfect for professionals and students.',
                'user_id' => $user->id,
            ],
            [
                'name' => 'AirPods Pro (2nd Gen)',
                'price' => 249.99,
                'description' => 'Wireless earbuds with active noise cancellation and spatial audio.',
                'user_id' => $user->id,
            ],
            [
                'name' => 'iPad Pro 12.9"',
                'price' => 1099.00,
                'description' => 'Professional tablet with M2 chip, perfect for creative work and productivity.',
                'user_id' => $user->id,
            ],
            [
                'name' => 'Apple Watch Series 9',
                'price' => 399.99,
                'description' => 'Smartwatch with health monitoring, GPS, and always-on display.',
                'user_id' => $user->id,
            ],
            [
                'name' => 'Dell XPS 13',
                'price' => 899.00,
                'description' => 'Ultra-portable laptop with premium design and excellent performance.',
                'user_id' => $user->id,
            ],
            [
                'name' => 'Sony WH-1000XM5',
                'price' => 349.99,
                'description' => 'Premium wireless headphones with industry-leading noise cancellation.',
                'user_id' => $user->id,
            ],
            [
                'name' => 'Samsung Galaxy S24 Ultra',
                'price' => 1199.99,
                'description' => 'Flagship Android phone with S Pen, advanced cameras, and AI features.',
                'user_id' => $user->id,
            ],
            [
                'name' => 'Nintendo Switch OLED',
                'price' => 349.99,
                'description' => 'Portable gaming console with vibrant OLED screen and dock for TV play.',
                'user_id' => $user->id,
            ],
            [
                'name' => 'Mechanical Keyboard',
                'price' => 159.99,
                'description' => 'Premium mechanical keyboard with RGB lighting and tactile switches.',
                'user_id' => $user->id,
            ],
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        }

        $this->command->info('Created ' . count($products) . ' sample products.');
    }
