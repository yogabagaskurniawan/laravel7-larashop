<?php

use App\Models\Categories;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Pakaian Anak',
                'slug' => 'pakaian-anak',
                'parent_id' => 0,
            ],
            [
                'name' => 'Pakaian Pria',
                'slug' => 'pakaian-pria',
                'parent_id' => 0,
            ],
            [
                'name' => 'Electronik',
                'slug' => 'electronik',
                'parent_id' => 0,
            ],
        ];
    
        Categories::insert($data);
    }
}
