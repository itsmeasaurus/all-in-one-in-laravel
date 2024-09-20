<?php

namespace App\Repository;

interface PostRepositoryInterface
{
    public function getAll(array $params);
    public function getById(int $id);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
}