<?php

namespace App\Http\Controllers;

use App\Core\Router;
use App\Core\Request;
use App\Core\Session;
use App\Core\Response;
use App\Enums\ProjectStatus;
use App\Enums\ProposalStatus;
use App\Enums\UserRole;
use App\Http\Request\ProposalStoreRequest;
use App\Models\Architect;
use App\Models\Project;
use App\Models\Proposal;

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
        if (auth()->user()->role === UserRole::ARCHITECT->value) {
            $slug = $request->params()->slug;
            $project = Project::findBySlug($slug);
            $architect = Architect::find('user_id', auth()->user()->id, ['id']);

            Response::view('proposal/create', [
                'slug' => $slug,
                'project' => $project,
                'architect' => $architect->id,
                'errors' => Session::get('errors')
            ]);
        } else {
            Response::redirect('/dashboard');
        }
    }

    public function store(ProposalStoreRequest $request): void
    {
        if (auth()->user()->role !== UserRole::ARCHITECT->value) {
            abort(Response::HTTP_FORBIDDEN);
        }
        $data = $request->validated($request->rules());

        $proposal = new Proposal();

        $proposal->architect_id = $data['architect_id'];
        $proposal->project_id = $data['project_id'];
        $proposal->approach = $data['approach'];
        $proposal->timeline = $data['timeline'];
        $proposal->fees = $data['fees'];

        $proposal->save();

        Response::redirect("/projects/{$request->params()->slug}/proposals");
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
        $proposalId = $request->input('proposal_id');
        $projectId = $request->input('project_id');

        $proposal = Proposal::findById($proposalId);
        $project = Project::findById($projectId);
        $architectId = $proposal->architect_id;

        if ($project && $proposal && $project->status === ProjectStatus::PENDING->value) {
            $proposal = new Proposal();

            $proposal->id = $proposalId;
            $proposal->status = ProposalStatus::APPROVED->value;

            $proposal->save();

            $proposals = Proposal::where('project_id', $projectId)->get(['id', 'status']);
            foreach ($proposals as $proposal) {
                if ($proposal->id != $proposalId && $proposal->status === ProposalStatus::PENDING->value) {
                    $object = new Proposal();
                    $object->id = $proposal->id;
                    $object->status = ProposalStatus::REJECTED->value;
                    $object->save();
                }
            }

            $newProject = new Project();

            $newProject->id = $projectId;
            $newProject->architect_id = $architectId;
            $newProject->status = ProjectStatus::IN_PROGRESS->value;

            $newProject->save();

            Session::flash('success', 'Proposal accepted and architect assigned.');

            return Response::redirect(Router::previousUrl());
        }
        Session::flash('error', 'Unable to accept proposal.');
        return Response::redirect(Router::previousUrl());
    }
}
