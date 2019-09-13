<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthorsTest extends TestCase
{
    use RefreshDatabase;

    /** Test for changes in authors database table */
    public function testAuthorTableChanges()
    {
        $attributes = [
            'author_name' => 'J.K. Rowling',
            'date_of_borth' => '1945-02-16',
            'author_address' => 'London'
        ];
        //passing necessarily data
        $this->post('/authors', $attributes);

        //new author should be created
        $this->assertDatabaseHas('authors', $attributes);
    }
}
