<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Proposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'architect_id',
        'project_id',
        'title',
        'description',
        'price',
        'status',
        'deadline'
    ];

    /**
     * Get the project that owns the Proposal
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get the architect that owns the Proposal
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function architect(): BelongsTo
    {
        return $this->belongsTo(Architect::class);
    }

    public static function saveProposal($data): Proposal
    {
        $proposal = new Proposal();

        $proposal->architect_id = auth()->user()->architect->id;
        $proposal->project_id = $data['project_id'];
        $proposal->title = $data['title'];
        $proposal->description = $data['description'];
        $proposal->price = $data['price'];
        $proposal->deadline = $data['deadline'];
        $proposal->status = 'pending';

        $proposal->save();

        return $proposal;
    }

    /**
     * Scope a query to only include proposals for a specific project.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string|int  $project_id
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVisibleProposal(Builder $query, string|int $project_id)
    {
        return $query->where('project_id', $project_id);
    }
}
