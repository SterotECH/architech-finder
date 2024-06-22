<div>
    {{ $this->projectInfolist }}
    @if (auth()->user()->isArchitect())
        @php
            $user = auth()->user();
            $proposal = $project->proposals->firstWhere('architect_id', $user->architect->id);
        @endphp
        @if ($proposal)
            <a href="{{ route('projects.proposals.edit', [$project, $proposal]) }}">
                <x-filament::button type="submit" color="secondary" icon="heroicon-s-pencil-square">
                    Edit Proposal
                </x-filament::button>
            </a>
        @else
            <a href="{{ route('projects.proposals.create', $project) }}">
                <x-filament::button type="submit" color="secondary" icon="heroicon-s-plus">
                    Add Proposal
                </x-filament::button>
            </a>
        @endif
    @endif
</div>
