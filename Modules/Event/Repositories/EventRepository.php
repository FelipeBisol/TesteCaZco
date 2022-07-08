<?php

namespace Modules\Event\Repositories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Modules\Event\Entities\Event;

class EventRepository implements IRepository
{
    private Builder $event;

    public function __construct(Event $model)
    {
        $this->event = $model->newQuery();
    }

    public function create($data): bool
    {
        try {
            $data['event_time'] = \DateTime::createFromFormat('d/m/Y G:i', $data['event_time'])->format('Y/m/d G:i:s');
            $this->event->create($data);
            return true;
        }catch (\Exception $exception){
            return false;
        }
    }

    public function delete($id): bool
    {
        try {
            $this->event->find($id)->delete();
            return true;
        }catch (\Exception $exception){
            return false;
        }
    }

    public function update($id, $data): bool
    {
        try {
            if(isset($data['event_time'])){
                $data['event_time'] = \DateTime::createFromFormat('d/m/Y G:i', $data['event_time'])->format('Y/m/d G:i:s');
            }
            $this->event->find($id)->update($data);
            return true;
        }catch (\Exception $exception){
            return false;
        }
    }

    public function index($filter = null)
    {
        try {
            if(empty($filter)){
                $filter = Carbon::now();
            }else{
                $filter = \DateTime::createFromFormat('d-m-Y', $filter['day'])->format('Y-m-d');
            }

            return $this->event->select('id', 'name', 'description', 'event_time', 'email_to_notification')
                ->where('event_time', 'LIKE', "%{$filter}%")->get();

        }catch (\Exception $exception){
            return false;
        }
    }
}