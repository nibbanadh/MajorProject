<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'category_name'=> 'Electronic Devices',
                'created_at'=>'2021-03-03 07:58:59',
                'updated_at'=>'2021-03-03 07:58:59'
            ],[
                'category_name'=> 'Electronic Accessories',
                'created_at'=>'2021-03-03 07:59:26',
                'updated_at'=>'2021-03-03 07:59:26'
            ],[
                'category_name'=> 'Men\'s Fashion',
                'created_at'=>'2021-03-03 08:01:23',
                'updated_at'=>'2021-03-03 08:01:23'
            ],[
                'category_name'=> 'Women\'s Fashion',
                'created_at'=>'2021-03-03 08:01:35',
                'updated_at'=>'2021-03-03 08:01:35'
            ]
        ]);
    }
}
