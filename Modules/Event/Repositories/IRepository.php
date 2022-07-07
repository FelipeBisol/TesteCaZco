<?php

namespace Modules\Event\Repositories;

interface IRepository
{
    public function create($data): bool;
    public function delete($id): bool;
    public function update($id, $data): bool;
    public function index($filter = null);
}