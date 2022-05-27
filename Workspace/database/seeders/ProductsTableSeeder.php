<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('products')->insert(
            [
                [
                    'name' => 'Chair ',
                    'description' => 'Chair Home',
                    'price' => 80,
                    'category_id' => 1,
                    'photo' => '/images/chair.jpg',
                    'user_id' => 1
                ],
                [
                    'name' => 'Chair 2',
                    'description' => 'Chair Home',
                    'price' => 50,
                    'category_id' => 1,
                    'photo' => '/images/chair2.jpg',
                    'user_id' => 1

                ],
                [
                    'name' => 'Table',
                    'description' => 'Table Office',
                    'price' => 129,
                    'category_id' => 2,
                    'photo' => '/images/officeTable.jpg',
                    'user_id' => 1

                ],
                [
                    'name' => 'Table',
                    'description' => 'Table Office',
                    'price' => 189,
                    'category_id' => 2,
                    'photo' => '/images/officeTable2.jpg',
                    'user_id' => 1

                ],
            ]
        );
    }
}
