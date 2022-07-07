<?php

namespace Modules\Event\Http\Controllers;

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

    public function __construct()
    {
        $this->repository = new EventRepository(new Event());
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
        return response()->json(['message' => "Ocorreu um erro interno, caso continue entre em contato com administrador."], 500);
    }

    public function update(EventUpdateRequest $request, $id)
    {
        $update = $this->repository->update($id, $request->all());

        if($update){
            return response()->json(['message' => "O evento foi editado com sucesso."], 200);
        }
        return response()->json(['message' => "Ocorreu um erro interno, caso continue entre em contato com administrador."], 500);
    }


    public function destroy($id)
    {
        $delete = $this->repository->delete($id);

        if($delete){
            return response()->json(['message' => "O evento foi editado com sucesso."], 200);
        }
        return response()->json(['message' => "Ocorreu um erro interno, caso continue entre em contato com administrador."], 500);
    }
}
