<?php

namespace App\Interfaces;

interface DocumentInterface
{
    public function list(array $filters = []);

    public function create(array $data);

    public function delete(int $id);

    public function update(int $id, array $data);

    public function show(int $id);
}
