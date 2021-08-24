<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Dairy Products', 'Snacks', 'Hair Care', 'Oral Care', 'Fruits', 'Vegetables', 'Meat', 'Poultry'];

        for($i = 0; $i < count($categories); $i++){
            DB::table('categories')->insert([
                'category_description' => $categories[$i]
            ]);
        }

        \App\Models\User::factory(3)->create();
        \App\Models\Supplier::factory(3)->create();
        \App\Models\Brand::factory(3)->create();
    }
}
