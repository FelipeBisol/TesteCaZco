<?php

namespace Modules\Event\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Modules\Event\Entities\Event;

class EventRepository implements IRepository
{
    private Builder $builder;

    public function __construct()
    {
        $event = new Event();
        $this->builder = $event::query();
    }

    public function create($data): bool
    {
        try {
            Event::query()->create($data);
            return true;
        }catch (\Exception $exception){
            return false;
        }
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    public function filter()
    {
        // TODO: Implement filter() method.
    }
}