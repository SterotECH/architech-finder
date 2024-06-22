<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProposalRequest;
use App\Http\Requests\UpdateProposalRequest;
use App\Models\Project;
use App\Models\Proposal;
use App\Models\Team;
use Illuminate\Http\Request;

class ProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Project $project)
    {
        $proposals = $project->proposals;

        return view('proposals.index', compact('project', 'proposals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project)
    {
        return view('proposals.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProposalRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project, Proposal $proposal)
    {
        return view('proposals.show', compact('project', 'proposal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($project_slug, Proposal $proposal)
    {
        return view('proposals.edit', compact('project_slug', 'proposal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProposalRequest $request, Proposal $proposal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proposal $proposal)
    {
        //
    }

    public function acceptProposal(Project $project, Proposal $proposal)
    {
        Proposal::where('project_id', $project->id)
            ->where('id', '!=', $proposal->id)
            ->update(['status' => 'rejected']);

        // Accept the selected proposal
        $proposal->update(['status' => 'approved']);

        $project->update([
            'status' => 'published',
            'architect_id' => $proposal->architect_id,
        ]);

        return redirect()->route('projects.show', $project->slug)
            ->with('success', 'Proposal accepted successfully.');
    }
}
