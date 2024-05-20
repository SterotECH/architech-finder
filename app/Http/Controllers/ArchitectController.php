<?php

namespace App\Http\Controllers;

use App\Core\Session;
use App\Models\Architect;
use App\Core\Request;
use App\Core\Response;
use App\Core\Router;

class ArchitectController extends Controller
{
    public function index(): void
    {
        $architects = array(
            array(
                'first_name' => 'David',
                'last_name' => 'Jones',
                'portfolio_link' => 'https://davidjones.com/portfolio',
                'avatar' => 'images/david_jones.jpg', // Replace with the actual image path
                'speciality' => 'Residential Architecture',
                'years_of_experience' => 15,
            ),
            array(
                'first_name' => 'Alice',
                'last_name' => 'Wang',
                'portfolio_link' => 'https://alicewang.com/architecture',
                'avatar' => 'images/alice_wang.jpg', // Replace with the actual image path
                'speciality' => 'Sustainable Design',
                'years_of_experience' => 10,
            ),
            array(
                'first_name' => 'Kwame',
                'last_name' => 'Adu',
                'portfolio_link' => 'https://kwameadu.com',
                'avatar' => 'images/kwame_adu.jpg', // Replace with the actual image path
                'speciality' => 'Commercial Architecture',
                'years_of_experience' => 8,
            ),
            array(
                'first_name' => 'Isabella',
                'last_name' => 'Garcia',
                'portfolio_link' => 'https://isabellagarcia.net',
                'avatar' => 'images/isabella_garcia.jpg', // Replace with the actual image path
                'speciality' => 'Historic Preservation',
                'years_of_experience' => 12,
            ),
        );

        Response::view('architect/index', [
//            'architects'=> Architect::all(),
            'architects' => $architects,
        ]);
    }

    public function create(): void
    {
        Response::view('architect/create',[
            'errors' => Session::get('errors')
        ]);
    }

    public function store(Request $request): void
    {
        $architect = new Architect();

        $architect->save();

        Response::redirect(Router::previousUrl());

    }

    public function show(Request $request): void
    {
        $id = $request->params()->id;

        $architect = Architect::findById($id);
        Response::view('architect/show', [
            'architect' => $architect
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
        $request->validate([]);
        $architect = new Architect();

        $id = $request->params()->id;
        $architect->id = $id;

        $architect->save();

        Response::redirect(Router::previousUrl());
    }

    public function destroy(Request $request): void
    {
        Architect::delete($request->params()->id);

        Response::redirect(Router::previousUrl());
    }
}