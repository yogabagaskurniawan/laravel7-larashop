<?php

use App\Models\AttributeOption;
use Illuminate\Database\Seeder;

class AttributeOptionSeeder extends Seeder
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
                'attribute_id' => '1',
                'name' => 'Hijau',
            ],
            [
                'attribute_id' => '1',
                'name' => 'Kuning',
            ],
            [
                'attribute_id' => '1',
                'name' => 'Merah',
            ],
            [
                'attribute_id' => '2',
                'name' => 'XL',
            ],
            [
                'attribute_id' => '2',
                'name' => 'M',
            ],
            [
                'attribute_id' => '2',
                'name' => 'L',
            ],
        ];

        AttributeOption::insert($data);
    }
}
