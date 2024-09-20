<?php

namespace App\Http\Controllers;

use App\Exceptions\GeneralJsonException;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Repository\PostRepositoryInterface;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }
    
    public function index(Request $request)
    {
        try {
            $params = [
                'per_page' => $request->per_page?? 20,
                'sort' => $request->sort?? 'created_at',
                'order' => $request->order?? 'desc'
            ];
            $posts = $this->postRepository->getAll($params);

            return PostResource::collection($posts);
        } catch (\Exception $e) {
            throw new GeneralJsonException('Error getting posts: ', 404);
        }
    }

    public function store(Request $request)
    {
        try {
            $post = $this->postRepository->create($request->only(['title', 'body', 'user_ids']));

            return new PostResource($post);
        } catch (\Exception $e) {
            throw new GeneralJsonException('Error creating post: ', 500);
        }
    }
    
    public function show($id)
    {
        try {
            $post = $this->postRepository->getById($id);

            return new PostResource($post);
        } catch (\Exception $e) {
            throw new GeneralJsonException('Error getting post: ', 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $post = $this->postRepository->update($id, $request->only(['title', 'body', 'user_ids']));

            return new PostResource($post);
        } catch (\Exception $e) {
            throw new GeneralJsonException('Error updating post: ', 500);
        }
    }

    public function delete($id)
    {
        try {
            $this->postRepository->delete($id);

            return response()->json(['message' => 'Post deleted successfully']);
        } catch (\Exception $e) {
            throw new GeneralJsonException('Error deleting post: ', 404);
        }
    }
}
