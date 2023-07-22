<?php

use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands')->insert([
            [
                'brand_name'=> 'Levi\'s',
                'brand_logo'=> 'public/media/brand/090321_08_12_52.png',
                'created_at'=>'2021-03-03 07:58:59',
                'updated_at'=>'2021-03-03 07:58:59'
            ],[
                'brand_name'=> 'Adidas',
                'brand_logo'=> 'public/media/brand/090321_08_33_52.png',
                'created_at'=>'2021-03-03 07:59:26',
                'updated_at'=>'2021-03-03 07:59:26'
            ],[
                'brand_name'=> 'Asus',
                'brand_logo'=> 'public/media/brand/090321_08_49_52.png',
                'created_at'=>'2021-03-03 08:01:23',
                'updated_at'=>'2021-03-03 08:01:23'
            ],[
                'brand_name'=> 'Canon',
                'brand_logo'=> 'public/media/brand/090321_08_09_53.png',
                'created_at'=>'2021-03-03 08:01:35',
                'updated_at'=>'2021-03-03 08:01:35'
            ],[
                'brand_name'=> 'Dell',
                'brand_logo'=> 'public/media/brand/090321_08_25_53.png',
                'created_at'=>'2021-03-03 08:01:35',
                'updated_at'=>'2021-03-03 08:01:35'
            ],[
                'brand_name'=> 'Lenovo',
                'brand_logo'=> 'public/media/brand/090321_08_41_53.png',
                'created_at'=>'2021-03-03 08:01:35',
                'updated_at'=>'2021-03-03 08:01:35'
            ]
        ]);
    }
}
