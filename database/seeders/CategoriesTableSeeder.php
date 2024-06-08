<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Holiday Villa'],
            ['name' => 'Rental Villa'],
            ['name' => 'Villa for Sale']
        ];

        Category::insert($categories);
    }
}
