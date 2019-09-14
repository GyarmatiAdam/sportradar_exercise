<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthorsTest extends TestCase
{
    use RefreshDatabase;

    /** Asserting that a row in the table [authors] matches the attributes*/
    public function testAuthorsTableHasAttributes()
    {
        $attributes = [
            'name' => 'J.K. Rowling',
            'date_of_birth' => '1945-02-16',
            'address' => 'London'
        ];

        $this->post('/authors', $attributes);

        $this->assertDatabaseHas('authors', $attributes);
    }
}
