<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('articles')->delete();

        $user = User::where(User::FIELD_ACCOUNT_TYPE, 'publisher')->first();
        for ($i=0; $i<10; $i++)
        {
            DB::table('articles')->insert([
                'title' => 'Title'.$i,
                'text' => 'Sample test for article number '.$i,
                'user_id' => $user->id,
                'published' => true,
                'favorite' => false
            ]);
        }

    }
}
