<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Author;

class AuthorTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_get_all_authors()
    {
        Author::factory()->count(3)->create();

        $response = $this->getJson('/api/authors');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    /** @test */
    public function it_can_create_an_author()
    {
        $data = [
            'name' => 'George Orwell',
        ];

        $response = $this->postJson('/api/authors', $data);

        $response->assertStatus(201)
                 ->assertJson(['name' => 'George Orwell']);
    }

    /** @test */
    public function it_can_get_a_single_author()
    {
        $author = Author::factory()->create();

        $response = $this->getJson("/api/authors/{$author->id}");

        $response->assertStatus(200)
                 ->assertJson(['id' => $author->id]);
    }

    /** @test */
    public function it_can_update_an_author()
    {
        $author = Author::factory()->create();

        $data = [
            'name' => 'Updated Name',
        ];

        $response = $this->putJson("/api/authors/{$author->id}", $data);

        $response->assertStatus(200)
                 ->assertJson(['name' => 'Updated Name']);
    }

    /** @test */
    public function it_can_delete_an_author()
    {
        $author = Author::factory()->create();

        $response = $this->deleteJson("/api/authors/{$author->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('authors', ['id' => $author->id]);
    }
}