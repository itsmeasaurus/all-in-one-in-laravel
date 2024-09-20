<?php

namespace App\Http\Controllers;

use App\Exceptions\GeneralJsonException;
use App\Exceptions\RepositoryException;
use App\Http\Resources\UserResource;
use App\Repository\UserRespositoryInterface;
use Illuminate\Cache\Repository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRespositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        // Test
        event(new \App\Events\UserRegistered(\App\Models\User::latest()->first()));
        try {
            $params = [
                'per_page' => $request->per_page ?? 20,
                'sort' => $request->sort ?? 'created_at',
                'order' => $request->order ?? 'desc'
            ];
            $users = $this->userRepository->all($params);
            return UserResource::collection($users);
        } catch (RepositoryException $e) {
            throw new GeneralJsonException('Error returning data', 404);
        }
    }

    public function store(Request $request)
    {
        try {
            $user = $this->userRepository->create($request->only(['name', 'email', 'password']));
            return new UserResource($user);
        } catch (RepositoryException $e) {
            throw new GeneralJsonException('Error creating user', 500);
        }
    }

    public function show($id)
    {
        try {
            $user = $this->userRepository->find($id);
            return new UserResource($user);
        } catch (RepositoryException $e) {
            throw new GeneralJsonException('Error retrieving user', 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = $this->userRepository->update($request->only(['name', 'email', 'password']), $id);
            return new UserResource($user);
        } catch (RepositoryException $e) {
            throw new GeneralJsonException('Error updating user', 500);
        }
    }

    public function destroy($id)
    {
        try {
            $status = $this->userRepository->delete($id);
            return response()->json(['message' => 'User deleted successfully']);
        } catch (RepositoryException $e) {
            throw new GeneralJsonException('Error deleting user', 500);
        }
    }
}
