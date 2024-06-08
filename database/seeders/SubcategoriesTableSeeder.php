<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subcategory;
class SubcategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subcategories = [
            ['name' => 'Townhouse', 'category_id' => 2],
            ['name' => 'Condo', 'category_id' => 1],
            ['name' => 'Flat', 'category_id' => 3],
            ['name' => 'Rowhouse', 'category_id' => 1],
            ['name' => 'Villa', 'category_id' => 2]
        ];

        Subcategory::insert($subcategories);
    }
}
