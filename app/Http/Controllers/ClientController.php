<?php

namespace App\Http\Controllers;

use App\Core\Router;
use App\Core\Request;
use App\Core\Response;
use App\Core\Session;
use App\Models\Client;
use App\Http\Request\ClientStoreRequest;

class ClientController extends Controller
{
    public function index(): void
    {
        Response::view('client/index', [
            'client\s'=> Client::all()
        ]);
    }

    public function create(): void
    {
        Response::view('client/create',[
            'errors' => Session::get('errors'),
        ]);
    }

    public function store(Request $request): void
    {
//        $storeRequest = new ClientStoreRequest();

//        $request->validate($storeRequest->rules());
        $user = UserController::store($request);

        $client = new Client();

        $client->user_id = $user->id;
        $client->address = $request->input('address');

        $client->save();

        Response::redirect(Router::previousUrl());

    }

    public function show(Request $request): void
    {
        $id = $request->params()->id;

        $client = Client::findById($id);
        Response::view('client/show', [
            'client' => $client
        ]);
    }

    public function edit(Request $request): void
    {
        $id = $request->params()->id;
        $client = Client::findById($id);

        Response::view('client/edit', [
            'client' => $client,
        ]);
    }

    public function update(Request $request): void
    {
        $request->validate([]);
        $client = new Client();

        $id = $request->params()->id;
        $client->id = $id;

        $client->save();

        Response::redirect(Router::previousUrl());
    }

    public function destroy(Request $request): void
    {
        Client::delete($request->params()->id);

        Response::redirect(Router::previousUrl());
    }
}
