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
        factory(App\Authors::class, 10)->create()->each(function ($authors) {
            
            $books = factory(App\Books::class, 3)->make();
            $authors->books()->saveMany($books);
        });
    }
}
