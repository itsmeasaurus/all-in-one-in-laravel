<?php

namespace App\Repository;

use App\Exceptions\RepositoryException;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostRepository implements PostRepositoryInterface
{
    public function getAll(array $params)
    {
        try {
            return Post::query()
                ->orderBy($params['sort'], $params['order'])
                ->paginate($params['per_page']);
        } catch (\Exception $e) {
            throw new RepositoryException('Failed to get all posts.', 500);
        }
    }

    public function getById(int $id)
    {
        try {
            return Post::find($id);
        } catch (\Exception $e) {
            throw new RepositoryException('Failed to get post by ID.', 500);
        }
    }

    public function create(array $data)
    {
        try {
            return DB::transaction(function () use ($data) {
                $post = Post::create([
                    'title' => $data['title'],
                    'body' => $data['body']
                ]);
                $post->users()->attach($data['user_ids']);

                return $post;
            });
        } catch (\Exception $e) {
            throw new RepositoryException('Failed to create post.', 500);
        }
    }

    public function update(int $id, array $data)
    {
        try {
            return DB::transaction(function () use ($id, $data) {
                $post = Post::find($id);
                $post->update($data);
                $post->users()->sync($data['user_ids']);

                return $post;
            });
        } catch (\Exception $e) {
            throw new RepositoryException('Failed to update post.', 500);
        }
    }

    public function delete(int $id)
    {
        try {
            $post = Post::find($id);
            $post->delete();

            return true;
        } catch (\Exception $e) {
            throw new RepositoryException('Failed to delete post.', 500);
        }
    }
}
