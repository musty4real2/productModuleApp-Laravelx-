<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class NewProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Get all existing users or create some if none exist
        $users = User::all();

        if ($users->isEmpty()) {
            $this->command->info('No users found. Creating sample users...');

            // Create multiple sample users for more realistic distribution
            $sampleUsers = [
                [
                    'name' => 'John Smith',
                    'email' => 'john@example.com',
                    'password' => bcrypt('password'),
                    'email_verified_at' => now(),
                ],
                [
                    'name' => 'Sarah Johnson',
                    'email' => 'sarah@example.com',
                    'password' => bcrypt('password'),
                    'email_verified_at' => now(),
                ],
                [
                    'name' => 'Mike Davis',
                    'email' => 'mike@example.com',
                    'password' => bcrypt('password'),
                    'email_verified_at' => now(),
                ],
                [
                    'name' => 'Emily Chen',
                    'email' => 'emily@example.com',
                    'password' => bcrypt('password'),
                    'email_verified_at' => now(),
                ],
            ];

            foreach ($sampleUsers as $userData) {
                User::create($userData);
            }

            $users = User::all();
            $this->command->info('Created ' . count($sampleUsers) . ' sample users.');
        }

        // Enhanced product categories with more variety
        $productCategories = [
            'Electronics' => [
                [
                    'name' => 'iPhone 15 Pro Max',
                    'price' => 1199.99,
                    'description' => 'Latest Apple iPhone with titanium design, A17 Pro chip, and professional camera system. Factory unlocked with 256GB storage.',
                ],
                [
                    'name' => 'Samsung Galaxy S24 Ultra',
                    'price' => 1299.99,
                    'description' => 'Flagship Android phone with S Pen, 200MP camera, and AI-powered features. Includes 512GB storage and premium case.',
                ],
                [
                    'name' => 'MacBook Pro 14" M3',
                    'price' => 1999.00,
                    'description' => 'Professional laptop with M3 chip, 16GB RAM, 512GB SSD. Perfect for developers and creative professionals.',
                ],
                [
                    'name' => 'iPad Pro 12.9" M2',
                    'price' => 1099.00,
                    'description' => 'Professional tablet with M2 chip, Liquid Retina XDR display, and Apple Pencil support. Includes Magic Keyboard.',
                ],
                [
                    'name' => 'Sony WH-1000XM5 Headphones',
                    'price' => 399.99,
                    'description' => 'Premium wireless headphones with industry-leading noise cancellation and 30-hour battery life.',
                ],
                [
                    'name' => 'Apple Watch Series 9 GPS',
                    'price' => 399.99,
                    'description' => 'Smartwatch with health monitoring, fitness tracking, and always-on Retina display. 45mm case with Sport Band.',
                ],
            ],
            'Gaming' => [
                [
                    'name' => 'PlayStation 5 Console',
                    'price' => 499.99,
                    'description' => 'Next-gen gaming console with ultra-fast SSD, ray tracing, and 3D audio. Includes DualSense controller.',
                ],
                [
                    'name' => 'Nintendo Switch OLED',
                    'price' => 349.99,
                    'description' => 'Portable gaming console with vibrant 7-inch OLED screen and enhanced audio for handheld and docked play.',
                ],
                [
                    'name' => 'Xbox Series X',
                    'price' => 499.99,
                    'description' => 'Powerful gaming console with 4K gaming, Quick Resume, and backward compatibility. Includes wireless controller.',
                ],
                [
                    'name' => 'Gaming PC Build - RTX 4070',
                    'price' => 1899.00,
                    'description' => 'Custom gaming PC with RTX 4070, Intel i7-13700K, 32GB RAM, and 1TB NVMe SSD. Ready to play any game.',
                ],
            ],
            'Home & Living' => [
                [
                    'name' => 'Herman Miller Aeron Chair',
                    'price' => 1395.00,
                    'description' => 'Ergonomic office chair in excellent condition. Size B with PostureFit lumbar support and adjustable arms.',
                ],
                [
                    'name' => 'KitchenAid Artisan Mixer',
                    'price' => 379.99,
                    'description' => '5-quart stand mixer in Empire Red with tilt-head design. Includes dough hook, flat beater, and wire whip.',
                ],
                [
                    'name' => 'Dyson V15 Detect Vacuum',
                    'price' => 749.99,
                    'description' => 'Cordless vacuum with laser dust detection and LCD screen. Includes multiple attachments and wall dock.',
                ],
                [
                    'name' => 'Instant Pot Pro 8-Quart',
                    'price' => 149.99,
                    'description' => '10-in-1 pressure cooker with sous vide capability. Perfect for meal prep and family cooking.',
                ],
            ],
            'Fashion & Accessories' => [
                [
                    'name' => 'Apple Watch Ultra 2',
                    'price' => 799.00,
                    'description' => 'Rugged smartwatch designed for extreme sports with titanium case and Ocean Band. GPS + Cellular.',
                ],
                [
                    'name' => 'Designer Leather Handbag',
                    'price' => 450.00,
                    'description' => 'Authentic designer handbag in excellent condition. Classic design with gold hardware and dust bag.',
                ],
                [
                    'name' => 'Vintage Rolex Submariner',
                    'price' => 12500.00,
                    'description' => '1985 Rolex Submariner Date in excellent condition. Recently serviced with box and papers.',
                ],
            ],
            'Sports & Fitness' => [
                [
                    'name' => 'Peloton Bike+ Indoor Cycling',
                    'price' => 2495.00,
                    'description' => 'Interactive exercise bike with rotating HD touchscreen and auto-follow resistance. Includes shoes and weights.',
                ],
                [
                    'name' => 'Bowflex SelectTech Dumbbells',
                    'price' => 549.00,
                    'description' => 'Adjustable dumbbells that replace 15 sets of weights. Each dumbbell adjusts from 5 to 52.5 pounds.',
                ],
            ],
            'Automotive' => [
                [
                    'name' => 'Tesla Model 3 Performance Wheels',
                    'price' => 1200.00,
                    'description' => 'Set of 4 Tesla Model 3 Performance wheels with Michelin Pilot Sport tires. Excellent condition.',
                ],
                [
                    'name' => 'Thule Roof Cargo Box',
                    'price' => 399.99,
                    'description' => 'Large capacity roof box for road trips and outdoor adventures. Fits most vehicles with roof rails.',
                ],
            ]
        ];

        // Create products with random assignments and timestamps
        $allProducts = collect($productCategories)->flatten(1);

        foreach ($allProducts as $productData) {
            // Add realistic timestamps
            $createdAt = $faker->dateTimeBetween('-6 months', '-1 day');
            $updatedAt = $faker->optional(0.3)->dateTimeBetween($createdAt, 'now') ?? $createdAt;

            Product::create([
                'name' => $productData['name'],
                'price' => $productData['price'],
                'description' => $productData['description'],
                'user_id' => $users->random()->id, // Randomly assign to existing users
                'created_at' => $createdAt,
                'updated_at' => $updatedAt,
            ]);
        }

        // Generate additional random products using Faker for more variety
        $additionalProductCount = 15;

        for ($i = 0; $i < $additionalProductCount; $i++) {
            $categories = ['Electronics', 'Home', 'Fashion', 'Sports', 'Books', 'Tools', 'Collectibles'];
            $category = $faker->randomElement($categories);

            $createdAt = $faker->dateTimeBetween('-6 months', '-1 day');
            $updatedAt = $faker->optional(0.2)->dateTimeBetween($createdAt, 'now') ?? $createdAt;

            Product::create([
                'name' => $faker->words(rand(2, 4), true) . ' ' . $category,
                'price' => $faker->randomFloat(2, 9.99, 2999.99),
                'description' => $faker->paragraph(rand(2, 4)),
                'user_id' => $users->random()->id,
                'created_at' => $createdAt,
                'updated_at' => $updatedAt,
            ]);
        }

        $totalProducts = $allProducts->count() + $additionalProductCount;
        $this->command->info("Created {$totalProducts} sample products distributed across {$users->count()} users.");
        $this->command->info('Products have realistic timestamps spanning the last 6 months.');
    }
}
