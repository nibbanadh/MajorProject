<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            // CategorySeeder::class,
            // SubcategorySeeder::class,
            // MinicategorySeeder::class,
            // BrandSeeder::class,
        ]);
    }
}
