<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name'=> 'Admin',
            'phone'=>'23233234',
            'email'=>'admins@gmail.com',
            'password'=>Hash::make('admins'),
        ]);
    }
}
