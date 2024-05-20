<?php

namespace App\Http\Controllers;

use App\Http\Request\UserStoreRequet;
use App\Models\User;
use App\Core\Request;
use App\Core\Session;
use App\Core\Response;
use App\Core\Authenticator;

class UserController extends Controller
{
    public function index(): void
    {
        Response::view('users/index', [
            'users' => User::all(),
            'heading' => 'Users'
        ]);
    }

    public function create(): void
    {
        Response::view('users/create', [
            'heading' => 'Create User',
            'errors' => Session::get('errors')
        ]);
    }

    public static function store(Request $request): object
    {
        $storeRequest = new UserStoreRequet();

        $request->validate($storeRequest->rules());

        $user = Authenticator::register((array)$request->all());
        Session::flash('success',"{$user->username} account has being created successfully");

        return $user;
    }


    public function show(Request $request): void
    {
        $id = $request->params()->id;
        $user = User::findById($id, columns:['id', 'first_name', 'last_name', 'phone_number', 'other_name', 'email']);
        Response::view("users/show", [
            "user" => $user,
            "heading" => "{$user['first_name']} {$user['last_name']}"
        ]);
    }

    public function edit(Request $request): void
    {
        $id = $request->params()->id;
        $user = User::findById($id, columns:['id', 'first_name', 'last_name', 'phone_number', 'other_name', 'email']);

        Response::view('users/edit', [
            'user' => $user,
            "heading" => "{$user['first_name']} {$user['last_name']}"
        ]);
    }

    public function update(Request $request): void
    {
        $request->validate([
            'username' => 'required|string|min:2|max:6',
            'first_name' => 'required|string|min:2|max:100',
            'last_name' => 'required|string|min:2|max:100',
            'email' => 'required|email',
            'password' => 'required|string|password',
            'phone_number' => 'required|phone',
            'other_name' => 'string|nullable',
            'password_confirmation' => 'password|confirm'
        ]);

        $user = new User();

        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->phone_number = $request->input('phone_number');
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->other_name = $request->input('other_name') ?? null;

        $user = $user->save();

        if ($user) {
            Response::redirect("/users/{$user[0]->id}/show");
        }
    }

    public function destroy(Request $request): void
    {
        $id = $request->params()->id;

        User::delete($id);

        Response::redirect('/');
    }
}
