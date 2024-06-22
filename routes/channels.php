<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat.{project_id}', function ($user, $project_id) {
    $project = App\Models\Project::find($project_id);

    if ($project) {
        return $user->id === $project->client->user_id || $user->id === $project->architect->user_id;
    }

    return false;
});
