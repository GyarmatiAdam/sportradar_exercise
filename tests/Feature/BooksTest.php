<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BooksTest extends TestCase
{
    use RefreshDatabase;

    /** Asserting that a row in the table [books] matches the attributes*/
    public function testBooksTableHasAttributes()
    {
        $this->withoutExceptionHandling();
        

        $attributes = [
            'name' => 'The Lord of the Rings',
            'release_date' => '1981-12-12',
            'authors_id' => '1'
        ];
        
        var_dump( $this->post('/books', $attributes));

        $this->assertDatabaseHas('books', $attributes);
    }
}
