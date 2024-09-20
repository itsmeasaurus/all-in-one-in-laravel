<?php

namespace App\Http\Controllers;

use App\Exceptions\GeneralJsonException;
use App\Http\Resources\CommentResource;
use App\Repository\CommentRepositoryInterface;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function index(Request $request)
    {
        try {
            $params = [
                'per_page' => $request->per_page ?? 20,
                'sort' => $request->sort ?? 'created_at',
                'order' => $request->order ?? 'desc'
            ];
            $comments = $this->commentRepository->getAll($params);

            return CommentResource::collection($comments);
        } catch (\Exception $e) {
            throw new GeneralJsonException('Failed to get comments', 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $comment = $this->commentRepository->create($request->only(['body', 'post_id', 'user_id']));

            return new CommentResource($comment);
        } catch (\Exception $e) {
            throw new GeneralJsonException('Failed to create comment', 500);
        }
    }

    public function show($id)
    {
        try {
            $comment = $this->commentRepository->getById($id);

            return new CommentResource($comment);
        } catch (\Exception $e) {
            throw new GeneralJsonException('Failed to get comment', 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $comment = $this->commentRepository->update($id, $request->only(['body', 'post_id', 'user_id']));

            return new CommentResource($comment);
        } catch (\Exception $e) {
            throw new GeneralJsonException('Failed to update comment', 500);
        }
    }

    public function destroy($id)
    {
        try {
            $status = $this->commentRepository->delete($id);

            return response()->json(['message' => 'Comment deleted successfully']);
        } catch (\Exception $e) {
            throw new GeneralJsonException('Failed to delete comment', 500);
        }
    }
}
