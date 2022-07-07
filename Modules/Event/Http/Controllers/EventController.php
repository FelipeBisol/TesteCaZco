<?php

namespace Modules\Event\Http\Controllers;

use App\Exceptions\InternalErrorException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Event\Entities\Event;
use Modules\Event\Http\Requests\EventIndexRequest;
use Modules\Event\Http\Requests\EventRequest;
use Modules\Event\Http\Requests\EventUpdateRequest;
use Modules\Event\Repositories\EventRepository;

class EventController extends Controller
{
    private EventRepository $repository;

    public function __construct(EventRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(EventIndexRequest $request)
    {
        //caso o input de filter esteja errado, deverá retornar erro 500
        $filter = $request->only('day');

        $this->repository->index($filter);
    }

    public function store(EventRequest $request)
    {
        $create = $this->repository->create($request->all());

        if($create){
            return response()->json(['message' => "O evento foi criado com sucesso."], 200);
        }
        throw new InternalErrorException();
    }

    public function update(EventUpdateRequest $request, $id)
    {
        $update = $this->repository->update($id, $request->all());

        if($update){
            return response()->json(['message' => "O evento foi editado com sucesso."], 200);
        }
        throw new InternalErrorException();
    }


    public function destroy($id)
    {
        $delete = $this->repository->delete($id);

        if($delete){
            return response()->json(['message' => "O evento foi editado com sucesso."], 200);
        }
        throw new InternalErrorException();
    }
}
