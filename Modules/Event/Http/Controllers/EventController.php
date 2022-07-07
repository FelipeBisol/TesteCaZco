<?php

namespace Modules\Event\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Event\Http\Requests\EventRequest;
use Modules\Event\Repositories\EventRepository;

class EventController extends Controller
{
    private EventRepository $repository;

    public function __construct()
    {
        $this->repository = new EventRepository();
    }

    public function index()
    {
        return view('event::index');
    }

    public function store(EventRequest $request)
    {
        $create = $this->repository->create($request->all());

        if($create){
            return response()->json(['message' => "O evento foi criado com sucesso."], 200);
        }
        return response()->json(['message' => "Ocorreu um erro interno, caso continue entre em contato com administrador."], 500);
    }

    public function show($id)
    {
        return view('event::show');
    }

    public function edit($id)
    {
        return view('event::edit');
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
