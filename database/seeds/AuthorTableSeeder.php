<?php

use Illuminate\Database\Seeder;

class AuthorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Authors::class, 10)->create()->each(function ($authors) {
            
            // $books = factory(App\Books::class, 30)->make();
            // $authors->books()->save($books);
        });
    }
}
