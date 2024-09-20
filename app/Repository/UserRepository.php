<?php

namespace App\Repository;

use App\Exceptions\RepositoryException;
use App\Models\User;
use Exception;

class UserRepository implements UserRespositoryInterface
{
    public function all(array $params)
    {
        try {
            return User::query()
                ->orderBy($params['sort'], $params['order'])
                ->paginate($params['per_page']);
        } catch (\Exception $e) {
            throw new RepositoryException('Error retrieving data:'.$e->getMessage());
        }
    }

    public function find($id)
    {
        try {
            return User::find($id);
        } catch (\Exception $e) {
            throw new RepositoryException('Error retrieving user:'.$e->getMessage());
        }
    }

    public function create(array $data)
    {
        try {
            return User::create($data);
        } catch (\Exception $e) {
            throw new RepositoryException('Error creating user:'.$e->getMessage());
        }
    }

    public function update(array $data, $id)
    {
        try {
            $user = User::find($id);
            $user->update($data);

            return $user;
        } catch (\Exception $e) {
            throw new RepositoryException('Error updating user:'.$e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $user = User::find($id);
            $user->delete();

            return true;
        } catch (\Exception $e) {
            throw new RepositoryException('Error deleting user:'.$e->getMessage());
        }
    }
}
