<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'description' => 'Mormai',
                'value' => 100,
                'code' => 1,
            ],
            [
                'description' => 'Rolex',
                'value' => 450,
                'code' => 2,
            ],
            [
                'description' => 'Xiaomi',
                'value' => 150,
                'code' => 3,
            ],
            [
                'description' => 'Apple Watch',
                'value' => 1500,
                'code' => 4,
            ],

            // cat 2

            [
                'description' => 'Motorola',
                'value' => 100,
                'code' => 5,
            ],
            [
                'description' => 'Xiami',
                'value' => 450,
                'code' => 6,
            ],
            [
                'description' => 'Samsung',
                'value' => 150,
                'code' => 7,
            ],
            [
                'description' => 'Iphone',
                'value' => 1500,
                'code' => 8,
            ],

        ];
        DB::table('products')->insert($products);
    }
}
