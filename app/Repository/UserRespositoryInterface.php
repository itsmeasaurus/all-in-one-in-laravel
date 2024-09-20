<?php

namespace App\Repository;

interface UserRespositoryInterface
{
    public function all(array $params);

    public function find($id);

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);
}