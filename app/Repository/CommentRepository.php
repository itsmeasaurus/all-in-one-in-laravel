<?php
namespace App\Repository;

use App\Exceptions\RepositoryException;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class CommentRepository implements CommentRepositoryInterface
{
    public function getAll(array $params)
    {
        try {
            return Comment::query()
                ->orderBy($params['sort'], $params['order'])
                ->paginate($params['per_page']);
        } catch (\Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }

    public function getById(int $id)
    {
        try {
            return Comment::find($id);
        } catch (\Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }

    public function create(array $data)
    {
        try {
            return Comment::create([
                'body' => $data['body'],
                'user_id' => $data['user_id'],
                'post_id' => $data['post_id']
            ]);
        } catch (\Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }

    public function update(int $id, array $data)
    {
        try {
            $comment = Comment::find($id);
            $comment->update($data);

            return $comment;
        } catch (\Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }

    public function delete(int $id)
    {
        try {
            $comment = Comment::find($id);
            $comment->delete();
            
            return true;
        } catch (\Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }
}