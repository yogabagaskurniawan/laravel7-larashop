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
                'parent_id' => NULL,
            ],
            [
                'name' => 'Pakaian Pria',
                'slug' => 'pakaian-pria',
                'parent_id' => NULL,
            ],
            [
                'name' => 'Electronik',
                'slug' => 'electronik',
                'parent_id' => NULL,
            ],
        ];
    
        Categories::insert($data);
    }
}
