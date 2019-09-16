<?php

use Illuminate\Database\Seeder;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Authors::class, 10)->create()->each(function ($authors) {
            
            $books = factory(App\Books::class, 3)->make();
            $authors->books()->saveMany($books);
        });
    }
}
