<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    protected $model = Property::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->numberBetween(500000000, 5000000000),
            'listing_type' => $this->faker->randomElement(['sale', 'rent']),
            'status' => $this->faker->randomElement(['active', 'sold', 'rented', 'inactive']),
            'province' => $this->faker->state(),
            'city' => $this->faker->city(),
            'district' => $this->faker->word(),
            'address' => $this->faker->address(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'land_size' => $this->faker->numberBetween(100, 1000),
            'building_size' => $this->faker->numberBetween(50, 500),
            'bedrooms' => $this->faker->numberBetween(1, 5),
            'bathrooms' => $this->faker->numberBetween(1, 3),
            'floors' => $this->faker->numberBetween(1, 3),
            'garages' => $this->faker->numberBetween(0, 2),
            'electricity' => $this->faker->numberBetween(900, 6600),
            'certificate' => $this->faker->randomElement(['shm', 'hgb', 'shgb', 'other']),
            'images' => json_encode([]),
            'video_url' => null,
            'facilities' => json_encode(['parking', 'pool', 'garden']),
            'featured' => $this->faker->boolean(30),
            'views' => $this->faker->numberBetween(0, 1000),
            'meta_title' => $this->faker->sentence(4),
            'meta_description' => $this->faker->sentence(10),
            'negotiable' => $this->faker->boolean(50),
        ];
    }
}