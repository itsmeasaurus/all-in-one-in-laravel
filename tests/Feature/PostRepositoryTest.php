<?php

namespace Tests\Unit;

use App\Models\Post;
use App\Models\User;
use App\Repository\PostRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    protected $postRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->postRepository = new PostRepository();
    }

    public function testGetAll()
    {
        $post = Post::factory()->create();

        $posts = $this->postRepository->getAll(['sort' => 'id', 'order' => 'desc', 'per_page' => 10]);

        $this->assertEquals(10, $posts->count());
        $this->assertEquals($post->id, $posts->first()->id);
    }

    public function testGetById()
    {
        $post = Post::factory()->create();

        $found = $this->postRepository->getById($post->id);

        $this->assertEquals($post->id, $found->id);
    }

    public function testCreate()
    {
        $user = User::factory()->create();

        $data = [
            'title' => 'Test Title',
            'body' => 'Test Body',
            'user_ids' => [$user->id]
        ];

        $post = $this->postRepository->create($data);

        $this->assertEquals($data['title'], $post->title);
        $this->assertEquals($data['body'], $post->body);
        $this->assertContains($user->id, $post->users->pluck('id'));
    }

    public function testUpdate()
    {
        $post = Post::factory()->create();
        $user = User::factory()->create();

        $data = [
            'title' => 'Updated Title',
            'body' => 'Updated Body',
            'user_ids' => [$user->id]
        ];

        $updatedPost = $this->postRepository->update($post->id, $data);

        $this->assertEquals($data['title'], $updatedPost->title);
        $this->assertEquals($data['body'], $updatedPost->body);
        $this->assertContains($user->id, $updatedPost->users->pluck('id'));
    }

    public function testDelete()
    {
        $post = Post::factory()->create();

        $result = $this->postRepository->delete($post->id);

        $this->assertTrue($result);
        $this->assertNull(Post::find($post->id));
    }
}