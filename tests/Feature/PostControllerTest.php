<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use DatabaseTransactions, WithoutMiddleware;

    public function test_index()
    {
        $posts = Post::factory()->count(10)->create();
        
        $response = $this->getJson('/api/v1/posts?per_page=10');
        
        $response->assertStatus(200); 

        $response->assertJsonCount(10, 'data');
        
    }

    public function test_store()
    {
        $post = Post::factory()->make();
        $post = $post->toArray();
        $post['user_ids'] = User::first()->id;
        
        $response = $this->postJson('/api/v1/posts', $post);
        
        $response->assertStatus(201); 

        $response->assertJsonPath(
            'data.title', $post['title']
        );

        $response->assertJsonPath(
            'data.body', $post['body']
        );
    }

    public function test_show()
    {
        $post = Post::factory()->create();
        
        $response = $this->getJson('/api/v1/posts/'.$post->id);
        
        $response->assertStatus(200); 

        $response->assertJsonPath(
            'data.title', $post->title
        );

        $response->assertJsonPath(
            'data.body', $post->body
        );
    }

    public function test_update()
    {
        $post = Post::factory()->create();
        $post = $post->toArray();
        $post['user_ids'] = User::first()->id;
        
        $response = $this->putJson('/api/v1/posts/'.$post['id'], $post);
        
        $response->assertStatus(200); 

        $response->assertJsonPath(
            'data.title', $post['title']
        );

        $response->assertJsonPath(
            'data.body', $post['body']
        );   
    }

    public function test_delete()
    {
        $post = Post::factory()->create();
        
        $response = $this->deleteJson('/api/v1/posts/'.$post->id);
        
        $response->assertStatus(200); 

        $response->assertJsonPath(
            'message', 'Post deleted successfully'
        );
    }


}
