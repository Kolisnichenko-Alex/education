<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('users')->delete();

        DB::table('users')->insert([
            'email' => 'admin.at@gmail.com',
            'password' => bcrypt('secret'),
            'name' => 'administrator',
            'account_type' => 'admin'
        ]);
    }
}
