<?php

namespace App\Http\Controllers;

use DateTime;
use App\Core\Router;
use App\Core\Request;
use App\Core\Session;
use App\Core\Response;
use App\Models\Client;
use App\Enums\UserRole;
use App\Models\Project;
use App\Models\Proposal;
use App\Models\Architect;
use App\Enums\ProjectType;
use App\Enums\ProjectStatus;
use App\Http\Request\ProjectStoreRequest;

class ProjectController extends Controller
{
    public function index(): void
    {


        Response::view('project/index', [
            'projects' => Project::getProjects()
        ]);
    }

    public function create(): void
    {
        Response::view('project/create', [
            'errors' => Session::get('errors')
        ]);
    }

    public function store(Request $request): void
    {
        $storeRequest = new ProjectStoreRequest();

        $request->validate($storeRequest->rules());

        $client = Client::where('user_id', auth()->user()->id)->first();

        if ($client) {
            $project = new Project();

            $project->client_id = $client->id;
            $project->title = $request->input('name');
            $project->slug = slugify($request->input('name'));
            $project->description = $request->input('description');
            $project->type = ProjectType::from($request->input('type'))->value;
            $project->status = ProjectStatus::PENDING->value;
            $project->budget = 0;

            $project->save();

            Response::redirect('/projects');
        }
        Response::redirect('/auth/login');
    }

    public function show(Request $request): void
    {
        $slug = $request->params()->id;

        $project = Project::getAllProjectsWithClients($slug);

        $proposals = Proposal::proposalWithArchitectsDetails($project[0]->id);

        $architect = null;
        if (auth()->user()->role === UserRole::ARCHITECT->value) {
            $architect = Architect::find('user_id', auth()->user()->id, ['id']);
        }

        $architect = Architect::find('user_id', auth()->user()->id, ['id']);

        Response::view('project/show', [
            'architect' => $architect ? $architect->id : null,
            'project' => $project[0],
            'proposals' => $proposals,
        ]);
    }

    public function edit(Request $request): void
    {
        $slug = $request->params()->id;
        $project = Project::findBySlug($slug);

        Response::view('project/edit', [
            'project' => $project,
        ]);
    }

    public function update(Request $request): void
    {
        $id = $request->params()->id;

        $project = new Project();

        $project->id = $id;
        $project->slug = slugify($request->input('title'));
        $project->title = $request->input('title');
        $project->type = ProjectType::from($request->input('type'))->value;
        $project->status = ProjectStatus::from($request->input('status'))->value;
        $project->description = $request->input('description');

        if ($request->input('status') === ProjectStatus::CANCELLED) {
            $project->cancelled_at = date('Y-m-d H:i:s');
        } elseif ($request->input('status') === ProjectStatus::COMPLETED) {
            $project->completed_at = date('Y-m-d H:i:s');
        }

        $project->save();

        Response::redirect("/projects/$project->slug");
    }

    public function destroy(Request $request): void
    {
        $project = new Project();

        $project->id = $request->params()->id;
        $project->deleted_at = date('y');

        $project->save();

        Response::redirect(Router::previousUrl());
    }
}
