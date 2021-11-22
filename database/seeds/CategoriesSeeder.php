<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('categories')->delete();

        DB::table('categories')->insert([
            'title' => 'General',
            'parent_category_id' => null
        ]);

        DB::table('categories')->insert([
            'title' => 'Important',
            'parent_category_id' => null
        ]);

        DB::table('categories')->insert([
            'title' => 'Unsorted',
            'parent_category_id' => null
        ]);
    }
}
