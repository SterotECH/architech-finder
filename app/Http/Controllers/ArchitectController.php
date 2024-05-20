<?php

namespace App\Http\Controllers;

use App\Models\ArchitectController;
use App\Core\Request;
use App\Core\Response;
use App\Core\Router;

class ArchitectControllerController extends Controller
{
    public function index(): void
    {
        Response::view('architectcontroller/index', [
            'architectcontroller\s'=> ArchitectController::all()
        ]);
    }

    public function create(): void
    {
        Response::view('architectcontroller/create',[
            'errors' => Session::get('errors')
        ]);
    }

    public function store(Request $request): void
    {
        $architectcontroller = new ArchitectController();

        $architectcontroller\->save();

        Response::redirect(Router::previousUrl());

    }

    public function show(Request $request): void
    {
        $id = $request->params()->id;

        $architectcontroller = ArchitectController::findById($id);
        Response::view('architectcontroller/show', [
            'architectcontroller' => $architectcontroller
        ]);
    }

    public function edit(Request $request): void
    {
        $id = $request->params()->id;
        $architectcontroller = ArchitectController::findById($id);

        Response::view('architectcontroller/edit', [
            'architectcontroller' => $architectcontroller,
        ]);
    }

    public function update(Request $request): void
    {
        $request->validate([]);
        $architectcontroller = new ArchitectController();

        $id = $request->params()->id;
        $architectcontroller\->id = $id;

        $architectcontroller\->save();

        Response::redirect(Router::previousUrl());
    }

    public function destroy(Request $request): void
    {
        ArchitectController::delete($request->params()->id);

        Response::redirect(Router::previousUrl());
    }
}