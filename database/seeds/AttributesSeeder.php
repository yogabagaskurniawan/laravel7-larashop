<?php

use App\Models\Attribute;
use Illuminate\Database\Seeder;

class AttributesSeeder extends Seeder
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
                'code' => 'warna',
                'name' => 'Warna',
                'type' => 'Select',
                'is_filterable' => 1,
                'is_configurable' => 1,
            ],
            [
                'code' => 'size',
                'name' => 'Size',
                'type' => 'Select',
                'is_filterable' => 1,
                'is_configurable' => 1,
            ],
        ];

        Attribute::insert($data);
    }
}
