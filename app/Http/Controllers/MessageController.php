<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Core\Request;
use App\Core\Response;
use App\Core\Router;
use App\Models\Project;

class MessageController extends Controller
{
    public function index()
    {

        return Response::view('message/index', [
            'projects' => Project::getProjects(),
            'messages' => Message::getMessages(),
        ]);
    }

    public function create()
    {
        Response::view('message/create', []);
    }

    public function store($data)
    {
        if (empty($data['sender_id']) || empty($data['receiver_id']) || empty($data['message'])) {
            return ['status' => 'error', 'message' => 'Invalid input'];
        }

        $result = Message::create($data['sender_id'], $data['receiver_id'], $data['project_id'], $data['message']);
        return $result ? ['status' => 'success', 'message' => 'Message sent'] : ['status' => 'error', 'message' => 'Failed to send message'];
    }

    public function edit(Request $request)
    {
        $slug = $request->params()->slug;

        $project = Project::findBySlug($slug);

        $message = Message::where('project_id', $project->id);

        Response::view('message/create', [
            'message' => $message
        ]);
    }

    public function update($id, $data)
    {
        $result = Message::update($id, $data['message']);
        return $result ? ['status' => 'success', 'message' => 'Message updated'] : ['status' => 'error', 'message' => 'Failed to update message'];
    }

    public function delete($id)
    {
        $result = Message::delete($id);
        return $result ? ['status' => 'success', 'message' => 'Message deleted'] : ['status' => 'error', 'message' => 'Failed to delete message'];
    }
}
