<?php

use Illuminate\Database\Seeder;

class MinicategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('minicategories')->insert([
            [
                'category_id'=>'1',
                'subcategory_id'=> '1',
                'minicategory_name'=> 'Apple Iphone',
                'created_at'=>'2021-03-03 07:58:59',
                'updated_at'=>'2021-03-03 07:58:59'
            ],[
                'category_id'=>'1',
                'subcategory_id'=> '1',
                'minicategory_name'=> 'Samsung',
                'created_at'=>'2021-03-03 07:59:26',
                'updated_at'=>'2021-03-03 07:59:26'
            ],[
                'category_id'=>'1',
                'subcategory_id'=> '1',
                'minicategory_name'=> 'Mi/Redmi',
                'created_at'=>'2021-03-03 08:01:23',
                'updated_at'=>'2021-03-03 08:01:23'
            ],[
                'category_id'=>'1',
                'subcategory_id'=> '2',
                'minicategory_name'=> 'Notebooks & Ultrabooks',
                'created_at'=>'2021-03-03 08:01:35',
                'updated_at'=>'2021-03-03 08:01:35'
            ],[
                'category_id'=>'1',
                'subcategory_id'=> '2',
                'minicategory_name'=> 'Gaming Laptops',
                'created_at'=>'2021-03-03 08:01:35',
                'updated_at'=>'2021-03-03 08:01:35'
            ],[
                'category_id'=>'1',
                'subcategory_id'=> '2',
                'minicategory_name'=> 'Macbooks',
                'created_at'=>'2021-03-03 08:01:35',
                'updated_at'=>'2021-03-03 08:01:35'
            ],[
                'category_id'=>'2',
                'subcategory_id'=> '4',
                'minicategory_name'=> 'Phone Cases',
                'created_at'=>'2021-03-03 08:01:35',
                'updated_at'=>'2021-03-03 08:01:35'
            ],[
                'category_id'=>'2',
                'subcategory_id'=> '4',
                'minicategory_name'=> 'Screen Proctectors',
                'created_at'=>'2021-03-03 08:01:35',
                'updated_at'=>'2021-03-03 08:01:35'
            ],[
                'category_id'=>'2',
                'subcategory_id'=> '4',
                'minicategory_name'=> 'Power Banks',
                'created_at'=>'2021-03-03 08:01:35',
                'updated_at'=>'2021-03-03 08:01:35'
            ],[
                'category_id'=>'2',
                'subcategory_id'=> '5',
                'minicategory_name'=> 'Headphones & Headsets',
                'created_at'=>'2021-03-03 08:01:35',
                'updated_at'=>'2021-03-03 08:01:35'
            ]
        ]);
    }
}
