<?php

namespace App\Http\Controllers;

use App\Core\Router;
use App\Core\Request;
use App\Core\Session;
use App\Core\Response;
use App\Enums\ProjectStatus;
use App\Enums\UserRole;
use App\Http\Request\ProposalStoreRequest;
use App\Models\Architect;
use App\Models\Client;
use App\Models\Project;
use App\Models\Proposal;
use stdClass;

class ProposalController extends Controller
{
    public function index(): void
    {
        Response::view('proposal/index', [
            'proposals' => Proposal::all()
        ]);
    }

    public function create(Request $request): void
    {
        if (auth()->user()->role === UserRole::ARCHITECT) {
            $slug = $request->params()->slug;
            $project = Project::findBySlug($slug);
            $architect = Architect::find('user_id', auth()->user()->id, ['id']);

            Response::view('proposal/create', [
                'slug' => $slug,
                'project' => $project,
                'architect' => $architect[0]->id,
                'errors' => Session::get('errors')
            ]);
        } else {
            Response::redirect('/dashboard');
        }
    }

    public function store(Request $request): void
    {
        if (auth()->user()->role === UserRole::ARCHITECT) {
            $validatedData = $request->validated([]);

            $proposal = new Proposal();
            $proposal->project_id = $validatedData['project_id'];
            $proposal->architect_id = $validatedData['architect_id'];
            $proposal->approach = $validatedData['approach'];
            $proposal->timeline = $validatedData['timeline'] ?? null;
            $proposal->fees = $validatedData['fees'] ?? null;

            $proposal->save();

            Response::redirect("/projects/{$request->params()->slug}/proposals");
        } else {
            abort(Response::HTTP_FORBIDDEN);
        }
    }

    public function show(Request $request): void
    {
        $id = $request->params()->id;

        $proposal = Proposal::findById($id);
        Response::view('proposal/show', [
            'proposal' => $proposal
        ]);
    }

    public function edit(Request $request): void
    {
        $id = $request->params()->id;
        $proposal = Proposal::findById($id);

        Response::view('proposal/edit', [
            'proposal' => $proposal,
        ]);
    }

    public function update(Request $request): void
    {
        $request->validate([]);
        $proposal = new Proposal();

        $id = $request->params()->id;
        $proposal->id = $id;

        $proposal->save();

        Response::redirect(Router::previousUrl());
    }

    public function destroy(Request $request): void
    {
        Proposal::delete($request->params()->id);

        Response::redirect(Router::previousUrl());
    }

    public function accept(Request $request)
    {
        $proposal = Proposal::findById($request->input('proposal_id'));
        $project = Project::findById($request->input('project_id'));

        if ($project && $proposal && $project->status === ProjectStatus::PENDING) {
            $proposal = new Proposal();

            $proposal->status = 'accepted';
            $proposal->save();

            $project = new Project();

            $project->architect_id = $proposal->architect_id;
            $project->status = ProjectStatus::IN_PROGRESS;

            $project->save();

            Session::flash('success', 'Proposal accepted and architect assigned.');

            return Response::redirect(Router::previousUrl());
        }
        Session::flash('error', 'Unable to accept proposal.');
        return Response::redirect(Router::previousUrl());
    }
}
