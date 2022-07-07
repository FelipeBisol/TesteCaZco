<?php

namespace Modules\Event\Repositories;

interface IRepository
{
    public function create();
    public function delete();
    public function update();
    public function filter();
}