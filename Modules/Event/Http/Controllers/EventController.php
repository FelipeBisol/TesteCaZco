<?php

namespace Modules\Event\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class EventController extends Controller
{

    public function index()
    {
        return view('event::index');
    }


    public function create()
    {
        return view('event::create');
    }


    public function store(Request $request)
    {
        //
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
