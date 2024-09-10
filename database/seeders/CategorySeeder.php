<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{

    public function run()
    {
        $categories = [
            'Electronics',
            'Clothing',
            'Books',
            'Toys',
            'Home & Kitchen',
            'Beauty & Personal Care',
            'Sports & Outdoors',
            'Automotive',
            'Music Instruments',
            'Office Supplies',
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category
            ]);
        }
    }
}
