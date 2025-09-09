<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Faker\Factory as Faker;

class ProductSeederWithImage extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Ensure storage directory exists
        Storage::disk('public')->makeDirectory('products');

        // Get all existing users or create some if none exist
        $users = User::all();

        if ($users->isEmpty()) {
            $this->command->info('No users found. Creating sample users...');

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

        // Products with specific image categories for better placeholder matching
        $productCategories = [
            'Electronics' => [
                [
                    'name' => 'iPhone 15 Pro Max',
                    'price' => 1199.99,
                    'description' => 'Latest Apple iPhone with titanium design, A17 Pro chip, and professional camera system. Factory unlocked with 256GB storage.',
                    'image_category' => 'phone',
                ],
                [
                    'name' => 'Samsung Galaxy S24 Ultra',
                    'price' => 1299.99,
                    'description' => 'Flagship Android phone with S Pen, 200MP camera, and AI-powered features. Includes 512GB storage and premium case.',
                    'image_category' => 'phone',
                ],
                [
                    'name' => 'MacBook Pro 14" M3',
                    'price' => 1999.00,
                    'description' => 'Professional laptop with M3 chip, 16GB RAM, 512GB SSD. Perfect for developers and creative professionals.',
                    'image_category' => 'laptop',
                ],
                [
                    'name' => 'iPad Pro 12.9" M2',
                    'price' => 1099.00,
                    'description' => 'Professional tablet with M2 chip, Liquid Retina XDR display, and Apple Pencil support. Includes Magic Keyboard.',
                    'image_category' => 'tablet',
                ],
                [
                    'name' => 'Sony WH-1000XM5 Headphones',
                    'price' => 399.99,
                    'description' => 'Premium wireless headphones with industry-leading noise cancellation and 30-hour battery life.',
                    'image_category' => 'headphones',
                ],
            ],
            'Gaming' => [
                [
                    'name' => 'PlayStation 5 Console',
                    'price' => 499.99,
                    'description' => 'Next-gen gaming console with ultra-fast SSD, ray tracing, and 3D audio. Includes DualSense controller.',
                    'image_category' => 'gaming',
                ],
                [
                    'name' => 'Nintendo Switch OLED',
                    'price' => 349.99,
                    'description' => 'Portable gaming console with vibrant 7-inch OLED screen and enhanced audio for handheld and docked play.',
                    'image_category' => 'gaming',
                ],
                [
                    'name' => 'Gaming PC Build - RTX 4070',
                    'price' => 1899.00,
                    'description' => 'Custom gaming PC with RTX 4070, Intel i7-13700K, 32GB RAM, and 1TB NVMe SSD. Ready to play any game.',
                    'image_category' => 'computer',
                ],
            ],
            'Home & Living' => [
                [
                    'name' => 'Herman Miller Aeron Chair',
                    'price' => 1395.00,
                    'description' => 'Ergonomic office chair in excellent condition. Size B with PostureFit lumbar support and adjustable arms.',
                    'image_category' => 'furniture',
                ],
                [
                    'name' => 'KitchenAid Artisan Mixer',
                    'price' => 379.99,
                    'description' => '5-quart stand mixer in Empire Red with tilt-head design. Includes dough hook, flat beater, and wire whip.',
                    'image_category' => 'appliance',
                ],
                [
                    'name' => 'Dyson V15 Detect Vacuum',
                    'price' => 749.99,
                    'description' => 'Cordless vacuum with laser dust detection and LCD screen. Includes multiple attachments and wall dock.',
                    'image_category' => 'appliance',
                ],
            ],
            'Fashion' => [
                [
                    'name' => 'Designer Leather Handbag',
                    'price' => 450.00,
                    'description' => 'Authentic designer handbag in excellent condition. Classic design with gold hardware and dust bag.',
                    'image_category' => 'fashion',
                ],
                [
                    'name' => 'Vintage Rolex Submariner',
                    'price' => 12500.00,
                    'description' => '1985 Rolex Submariner Date in excellent condition. Recently serviced with box and papers.',
                    'image_category' => 'watch',
                ],
            ],
        ];

        $productCount = 0;

        foreach ($productCategories as $category => $products) {
            foreach ($products as $productData) {
                $createdAt = $faker->dateTimeBetween('-6 months', '-1 day');
                $updatedAt = $faker->optional(0.3)->dateTimeBetween($createdAt, 'now') ?? $createdAt;

                // Download placeholder image
                $imagePath = $this->downloadPlaceholderImage($productData['image_category'], $productCount);

                Product::create([
                    'name' => $productData['name'],
                    'price' => $productData['price'],
                    'description' => $productData['description'],
                    'image' => $imagePath,
                    'user_id' => $users->random()->id,
                    'created_at' => $createdAt,
                    'updated_at' => $updatedAt,
                ]);

                $productCount++;
            }
        }

        // Generate additional random products
        for ($i = 0; $i < 10; $i++) {
            $categories = ['tech', 'home', 'fashion', 'sports', 'auto'];
            $category = $faker->randomElement($categories);

            $createdAt = $faker->dateTimeBetween('-6 months', '-1 day');
            $updatedAt = $faker->optional(0.2)->dateTimeBetween($createdAt, 'now') ?? $createdAt;

            $imagePath = $this->downloadPlaceholderImage($category, $productCount);

            Product::create([
                'name' => $faker->words(rand(2, 4), true),
                'price' => $faker->randomFloat(2, 9.99, 2999.99),
                'description' => $faker->paragraph(rand(2, 4)),
                'image' => $imagePath,
                'user_id' => $users->random()->id,
                'created_at' => $createdAt,
                'updated_at' => $updatedAt,
            ]);

            $productCount++;
        }

        $this->command->info("Created {$productCount} sample products with images.");
    }

    /**
     * Download placeholder image for product
     */
    private function downloadPlaceholderImage($category, $index): ?string
    {
        try {
            // Using Picsum for random product-like images
            $width = rand(400, 800);
            $height = rand(400, 800);
            $seed = $index; // Use index as seed for consistent images

            $imageUrl = "https://picsum.photos/seed/{$seed}/{$width}/{$height}";

            $response = Http::timeout(10)->get($imageUrl);

            if ($response->successful()) {
                $filename = "products/product_{$index}_{$category}.jpg";
                Storage::disk('public')->put($filename, $response->body());
                return $filename;
            }
        } catch (\Exception $e) {
            $this->command->warn("Failed to download image for product {$index}: " . $e->getMessage());
        }

        return null;
    }
}
