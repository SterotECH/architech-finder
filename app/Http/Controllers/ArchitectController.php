<?php

namespace App\Http\Controllers;

use App\Core\Router;
use App\Models\User;
use App\Core\Request;
use App\Core\Session;
use App\Core\Response;
use App\Models\Architect;

class ArchitectController extends Controller
{
    public function index(Request $request): void
    {
        $architects = Architect::getArchitectWithProfile();

        $search = $request->get('q') ?? '';
        $page = $request->get('page') ?? 1;
        $itemsPerPage = 12;

        $filteredArchitects = array_filter($architects, function ($architect) use ($search) {
            return stripos($architect->first_name, $search) !== false ||
                stripos($architect->last_name, $search) !== false ||
                stripos($architect->speciality, $search) !== false;
        });

        $totalItems = count($filteredArchitects);
        $totalPages = ceil($totalItems / $itemsPerPage);
        $offset = ($page - 1) * $itemsPerPage;
        $paginatedArchitects = array_slice($filteredArchitects, $offset, $itemsPerPage);

        Response::view('architect/index', [
            'architects' => $paginatedArchitects,
            'search' => $search,
            'page' => $page,
            'totalPages' => $totalPages,
            'totalItems' => $totalItems,
        ]);
    }


    public function create(): void
    {
        Response::view('architect/create', [
            'errors' => Session::get('errors')
        ]);
    }

    public function store(Request $request): void
    {
        $data = $request->all();

        // Create a new user
        $user = UserController::store($request);

        // Create a new architect profile
        $architect = new Architect();
        $architect->user_id = $user->id;
        $architect->experience = $data->experience;
        $architect->biography = $data->biography;
        $architect->qualifications = $data->qualifications;
        $architect->portfolio_link = $data->portfolio_link;
        $architect->save();

        // Redirect to the architect show page
        Response::redirect("/architects/{$architect->id}");
    }

    public function show(Request $request): void
    {
        $architect = Architect::architectProfileView($request->params()->id);

        Response::view('architect/show', [
            'architect' => $architect,
        ]);
    }

    public function edit(Request $request): void
    {
        $id = $request->params()->id;
        $architect = Architect::findById($id);

        Response::view('architect/edit', [
            'architect' => $architect,
        ]);
    }

    public function update(Request $request): void
    {
        $data = $request->all();
        $architect = Architect::findById($request->params()->id);

        // Validate data here

        $architect->experience = $data['experience'];
        $architect->biography = $data['biography'];
        $architect->qualifications = $data['qualifications'];
        $architect->portfolio_link = $data['portfolio_link'];
        $architect->save();

        // Redirect to the architect show page
        Response::redirect("/architects/{$architect->id}");
    }

    public function destroy(Request $request): void
    {
        Architect::delete($request->params()->id);

        Response::redirect(Router::previousUrl());
    }
}
