<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $demoz_category = [
            'Honey',
            'Natural oil',
            'Nuts',
            'Coconut',
            'Butter',
        ];

        foreach ($demoz_category as $value){
            Category::create([
                'title'=>$value,
                'slug'=>Str::slug($value)
            ]);
        }
    }
}
