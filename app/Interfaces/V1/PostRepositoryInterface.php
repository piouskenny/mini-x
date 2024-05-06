<?php

namespace App\Interfaces\V1;

interface PostRepositoryInterface
{
    public function all();

    public function create(array $data);

    public function edit(array $data);

    public function delete($id);
}

