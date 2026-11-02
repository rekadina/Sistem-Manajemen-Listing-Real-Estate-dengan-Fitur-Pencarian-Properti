<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Daftar Kategori Baru (Luxury)
         $categories = [
            ['name' => 'Apartments', 'slug' => 'apartments', 'icon' => '🏢'],
            ['name' => 'Penthouses', 'slug' => 'penthouses', 'icon' => '🏙️'],
            ['name' => 'Condos', 'slug' => 'condos', 'icon' => '🏘️'],
            ['name' => 'Mansions', 'slug' => 'mansions', 'icon' => '🏰'],
            ['name' => 'Villas', 'slug' => 'villas', 'icon' => '🏡'],
            ['name' => 'Town Houses', 'slug' => 'town-houses', 'icon' => '🏠'],
        ];

         foreach ($categories as $category) {
            Category::create($category);
        }

        echo "Categories seeded successfully!\n";
        // Hapus data lama (Truncate) agar tidak duplikat atau tercampur
        // Kita gunakan disableForeignKeyConstraints agar tidak error jika sudah ada properti yang terhubung
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('categories')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        // Masukkan data baru
        DB::table('categories')->insert($categories);

        echo "Categories seeded successfully!\n";
    }
}