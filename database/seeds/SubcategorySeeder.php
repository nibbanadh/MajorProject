<?php

use Illuminate\Database\Seeder;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subcategories')->insert([
            [
                'category_id'=> '1',
                'subcategory_name'=> 'Mobiles',
                'created_at'=>'2021-03-03 07:58:59',
                'updated_at'=>'2021-03-03 07:58:59'
            ],[
                'category_id'=> '1',
                'subcategory_name'=> 'Laptops',
                'created_at'=>'2021-03-03 07:58:59',
                'updated_at'=>'2021-03-03 07:58:59'
            ],[
                'category_id'=> '1',
                'subcategory_name'=> 'Desktops',
                'created_at'=>'2021-03-03 07:58:59',
                'updated_at'=>'2021-03-03 07:58:59'
            ],[
                'category_id'=> '2',
                'subcategory_name'=> 'Mobile Accessories',
                'created_at'=>'2021-03-03 07:59:26',
                'updated_at'=>'2021-03-03 07:59:26'
            ],[
                'category_id'=> '2',
                'subcategory_name'=> 'Audio',
                'created_at'=>'2021-03-03 07:59:26',
                'updated_at'=>'2021-03-03 07:59:26'
            ],[
                'category_id'=> '2',
                'subcategory_name'=> 'Computer Accessories',
                'created_at'=>'2021-03-03 07:59:26',
                'updated_at'=>'2021-03-03 07:59:26'
            ],[
                'category_id'=> '3',
                'subcategory_name'=> 'Clothing',
                'created_at'=>'2021-03-03 08:01:23',
                'updated_at'=>'2021-03-03 08:01:23'
            ],[
                'category_id'=> '3',
                'subcategory_name'=> 'Men\'s Bags',
                'created_at'=>'2021-03-03 08:01:23',
                'updated_at'=>'2021-03-03 08:01:23'
            ],[
                'category_id'=> '3',
                'subcategory_name'=> 'Shoes',
                'created_at'=>'2021-03-03 08:01:23',
                'updated_at'=>'2021-03-03 08:01:23'
            ],[
                'category_id'=> '4',
                'subcategory_name'=> 'Clothing',
                'created_at'=>'2021-03-03 08:01:35',
                'updated_at'=>'2021-03-03 08:01:35'
            ],[
                'category_id'=> '4',
                'subcategory_name'=> 'Women\'s Bags',
                'created_at'=>'2021-03-03 08:01:35',
                'updated_at'=>'2021-03-03 08:01:35'
            ],[
                'category_id'=> '4',
                'subcategory_name'=> 'Shoes',
                'created_at'=>'2021-03-03 08:01:23',
                'updated_at'=>'2021-03-03 08:01:23'
            ]
        ]);
    }
}
