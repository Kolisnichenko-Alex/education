<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' => 'noob.at@gmail.com',
            'password' => bcrypt('secret'),
            'name' => 'newby'
        ]);
    }
}
