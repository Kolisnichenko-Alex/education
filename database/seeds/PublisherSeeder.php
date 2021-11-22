<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' => 'publisher.at@gmail.com',
            'password' => bcrypt('secret'),
            'name' => 'testpublisher',
            'account_type' => 'publisher'
        ]);
    }
}
