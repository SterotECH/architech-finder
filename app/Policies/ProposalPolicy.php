<?php

namespace App\Policies;

use App\Models\Proposal;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProposalPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Proposal $proposal): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        if (
            ($proposal->architect_id === $user->architect->id)
            || ($proposal->project->client_id === $user->client->id)
        ) {
            return true;
        }


        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isArchitect() || $user->hasNoProposals();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Proposal $proposal): bool
    {
        return ($user->isArchitect() && $proposal->architect_id === $user->architect->id) || ($user->isClient() && $proposal->project->client_id === $user->client->id);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Proposal $proposal): bool
    {
        return $user->isArchitect() && $proposal->architect_id === $user->architect->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Proposal $proposal): bool
    {
        return $user->isArchitect() && $proposal->architect_id === $user->architect->id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Proposal $proposal): bool
    {
        return $user->isAdmin();
    }
}
