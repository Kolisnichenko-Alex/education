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
        $this->call(AdminSeeder::class);
        $this->call(PublisherSeeder::class);
        $this->call(ReaderSeeder::class);
        $this->call(ArticleSeeder::class);
        $this->call(CategoriesSeeder::class);
    }
}
