<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Book;
use App\Models\Author;

class BookTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_get_all_books()
    {
        Book::factory()->count(3)->create();

        $response = $this->getJson('/api/books');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    /** @test */
    public function it_can_create_a_book()
    {
        $author = Author::factory()->create();

        $data = [
            'title' => '1984',
            'genre' => 'Dystopian',
            'author_ids' => [$author->id],
        ];

        $response = $this->postJson('/api/books', $data);

        $response->assertStatus(201)
                 ->assertJson(['title' => '1984']);
    }

    /** @test */
    public function it_can_get_a_single_book()
    {
        $book = Book::factory()->create();

        $response = $this->getJson("/api/books/{$book->id}");

        $response->assertStatus(200)
                 ->assertJson(['id' => $book->id]);
    }

    /** @test */
    public function it_can_update_a_book()
    {
        $book = Book::factory()->create();
        $author = Author::factory()->create();

        $data = [
            'title' => 'Updated Title',
            'genre' => 'Updated Genre',
            'author_ids' => [$author->id],
        ];

        $response = $this->putJson("/api/books/{$book->id}", $data);

        $response->assertStatus(200)
                 ->assertJson(['title' => 'Updated Title']);
    }

    /** @test */
    public function it_can_delete_a_book()
    {
        $book = Book::factory()->create();

        $response = $this->deleteJson("/api/books/{$book->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }

    /** @test */
    public function it_can_search_books()
    {
        // Создаем книгу и автора
        $book = Book::factory()->create(['title' => '1984', 'genre' => 'Dystopian']);
        $author = Author::factory()->create(['name' => 'George Orwell']);
        $book->authors()->attach($author->id);

        // Выполняем поиск по названию, автору и жанру
        $response = $this->getJson('/api/books/search?title=1984&author=George+Orwell&genre=Dystopian');

        // Проверяем ответ
        $response->assertStatus(200)
                ->assertJsonCount(1)
                ->assertJson([
                    [
                        'title' => '1984',
                        'genre' => 'Dystopian',
                        'authors' => [
                            [
                                'name' => 'George Orwell',
                            ],
                        ],
                    ],
                ]);
    }
}