<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
         $this->call([
            SettingsSeeder::class,        // Data pengaturan website
            CategorySeeder::class,        // Data kategori properti
            UserSeeder::class,            // Data user/admin
            PropertySeeder::class,        // Data properti sample
            InquirySeeder::class,         // Data inquiry sample (opsional)
        ]);
        
        // Create test agent user
        $agent = User::create([
            'name' => 'John Luxury',
            'email' => 'agent@luxuryestate.com',
            'password' => Hash::make('password'),
            'phone' => '+1 (555) 123-4567',
            'is_agent' => true,
            'email_verified_at' => now(),
        ]);

        // Create categories
        $categories = [
            [
                'name' => 'Luxury Villas',
                'slug' => 'luxury-villas',
                'icon' => '🏰',
                'order' => 1,
                'description' => 'Exclusive villas with premium amenities and private spaces',
            ],
            [
                'name' => 'Penthouse Apartments',
                'slug' => 'penthouse-apartments',
                'icon' => '🏙️',
                'order' => 2,
                'description' => 'Top-floor luxury apartments with panoramic city views',
            ],
            [
                'name' => 'Waterfront Properties',
                'slug' => 'waterfront-properties',
                'icon' => '⛵',
                'order' => 3,
                'description' => 'Properties with direct water access and stunning views',
            ],
            [
                'name' => 'Luxury Condos',
                'slug' => 'luxury-condos',
                'icon' => '🏢',
                'order' => 4,
                'description' => 'Modern condominiums with premium amenities',
            ],
            [
                'name' => 'Commercial Real Estate',
                'slug' => 'commercial-real-estate',
                'icon' => '🏬',
                'order' => 5,
                'description' => 'Premium commercial spaces and office buildings',
            ],
            [
                'name' => 'Country Estates',
                'slug' => 'country-estates',
                'icon' => '🏡',
                'order' => 6,
                'description' => 'Spacious estates in countryside locations',
            ],
            [
                'name' => 'Luxury Townhouses',
                'slug' => 'luxury-townhouses',
                'icon' => '🏘️',
                'order' => 7,
                'description' => 'Modern townhouses in prime locations',
            ],
            [
                'name' => 'Investment Properties',
                'slug' => 'investment-properties',
                'icon' => '📈',
                'order' => 8,
                'description' => 'Properties with high investment potential',
            ],
        ];

        foreach ($categories as $categoryData) {
            Category::create($categoryData);
        }

        // Sample properties
        $properties = [
            [
                'title' => 'Modern Beverly Hills Villa with Pool',
                'description' => 'Stunning contemporary villa in the heart of Beverly Hills. Features include infinity pool, home theater, wine cellar, and smart home automation throughout.',
                'price' => 12500000,
                'category_id' => 1,
                'listing_type' => 'sale',
                'status' => 'active',
                'negotiable' => true,
                'province' => 'California',
                'city' => 'Beverly Hills',
                'district' => 'Beverly Hills',
                'address' => '123 Rodeo Drive',
                'latitude' => '34.073620',
                'longitude' => '-118.400352',
                'land_size' => 2000,
                'building_size' => 800,
                'bedrooms' => 6,
                'bathrooms' => 8,
                'floors' => 3,
                'garages' => 4,
                'electricity' => 15000,
                'certificate' => 'shm',
                'images' => json_encode(['properties/sample-1.jpg', 'properties/sample-2.jpg']),
                'facilities' => json_encode(['Swimming Pool', 'Home Theater', 'Wine Cellar', 'Smart Home', 'Security System']),
                'featured' => true,
                'user_id' => $agent->id,
                'agent_id' => $agent->id,
                'meta_title' => 'Modern Beverly Hills Villa for Sale',
                'meta_description' => 'Luxury villa in Beverly Hills with 6 bedrooms, 8 bathrooms, infinity pool, and smart home features.',
            ],
            [
                'title' => 'Penthouse with Panoramic City Views',
                'description' => 'Exclusive penthouse offering breathtaking 360-degree city views. Features floor-to-ceiling windows, private elevator, and rooftop terrace.',
                'price' => 8500000,
                'category_id' => 2,
                'listing_type' => 'sale',
                'status' => 'active',
                'negotiable' => false,
                'province' => 'New York',
                'city' => 'New York',
                'district' => 'Manhattan',
                'address' => '456 Park Avenue',
                'latitude' => '40.712776',
                'longitude' => '-74.005974',
                'land_size' => null,
                'building_size' => 450,
                'bedrooms' => 4,
                'bathrooms' => 5,
                'floors' => 1,
                'garages' => 2,
                'electricity' => 10000,
                'certificate' => 'condo',
                'images' => json_encode(['properties/sample-3.jpg', 'properties/sample-4.jpg']),
                'facilities' => json_encode(['Rooftop Terrace', 'Private Elevator', 'Concierge', 'Gym', 'Wine Storage']),
                'featured' => true,
                'user_id' => $agent->id,
                'agent_id' => $agent->id,
            ],
            // Add more sample properties...
        ];

        foreach ($properties as $propertyData) {
            Property::create($propertyData);
        }

        $this->command->info('Frontend data seeded successfully!');
        $this->command->info('Agent login: agent@luxuryestate.com / password');
    }
}