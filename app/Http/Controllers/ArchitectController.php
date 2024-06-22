<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\User;
use App\Models\Architect;
use App\Http\Requests\StoreArchitectRequest;
use App\Http\Requests\UpdateArchitectRequest;

class ArchitectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('architects.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('architects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public static function store(array $data)
    {
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'other_name' => $data['other_name'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => UserRole::ARCHITECT,
        ]);

        Architect::create([
            'user_id' => $user['id'],
            'experience' => $data['experience'],
            'bio' => $data['bio'],
            'qualifications' => $data['qualifications'],
        ]);

        return response()->json(['message' => 'Architect created successfully!'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Architect $architect)
    {
        return view('architects.show', ['architect' => $architect]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Architect $architect)
    {
        return view('architects.edit', ['architect' => $architect]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArchitectRequest $request, Architect $architect)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Architect $architect)
    {
        //
    }
}
