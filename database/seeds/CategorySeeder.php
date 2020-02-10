<?php

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

        $categories = [
            [
                'description' => 'Relógios', // 1
            ],
            [
                'description' => 'Smartphones', // 2
            ],
            [
                'description' => 'Informatica', // 3
            ],
            [
                'description' => 'Games', // 4
            ],
            [
                'description' => 'Moda', // 5
            ],
            [
                'description' => 'Petshop', // 6
            ],
            [
                'description' => 'Brinquedos', // 7
            ],
            [
                'description' => 'Pápelaria', // 8
            ],
            [
                'description' => 'Tv e video', // 9
            ],
            [
                'description' => 'Instrumentos', // 10
            ],
            [
                'description' => 'Decoração', // 11
            ]
        ];
        DB::table('categories')->insert($categories);
    }
}
