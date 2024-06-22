<?php

namespace App\Models;

use App\Enums\UserRole;
use App\Enums\ProjectType;
use Illuminate\Support\Str;
use App\Enums\ProjectStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'client_id',
        'architect_id',
        'title',
        'slug',
        'description',
        'status',
        'type',
    ];

    /**
     * Get the attributes that should be casted
     *
     * @var array
     */
    protected $cast = [
        'status' => ProjectStatus::class,
        'type' => ProjectType::class,
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($project) {
            $project->slug = self::generateUniqueSlug($project->title);
        });

        static::updating(function ($project) {
            if ($project->isDirty('title')) {
                $project->slug = self::generateUniqueSlug($project->title, $project->id);
            }
        });
    }

    /**
     * Get the client that owns the Project
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get the architect that owns the Project
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function architect(): BelongsTo
    {
        return $this->belongsTo(Architect::class,);
    }

    /**
     * Get all of the proposals for the Project
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function proposals(): HasMany
    {
        return $this->hasMany(Proposal::class);
    }

    /**
     * Generate a unique slug for the project title.
     *
     * @param string $title The project title.
     * @param int|null $excludeId An ID to exclude from the uniqueness check, usually the current project ID.
     * @return string The unique slug.
     */
    private static function generateUniqueSlug($title, $excludeId = null)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        while (self::where('slug', $slug)->when($excludeId, function ($query) use ($excludeId) {
            return $query->where('id', '!=', $excludeId);
        })->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    /**
     * Handle the creation and updating of projects.
     *
     * @param array $data The data to be saved.
     * @param int|null $id The ID of the project to update, or null to create a new project.
     * @return Project The saved project instance.
     */
    public static function saveProject(array $data, $id = null)
    {
        return DB::transaction(function () use ($data, $id) {
            if ($id) {
                $project = self::findOrFail($id);
                $project->fill($data);
            } else {
                $project = new self($data);
            }
            $client = Client::where('user_id', Auth::id())->pluck('id');

            $project->client_id = $client[0];
            $project->status = ProjectStatus::Draft->value;
            $project->slug = self::generateUniqueSlug($project->title, $project->id);
            $project->save();

            $architects = User::where('role', UserRole::ARCHITECT)->get();

            foreach ($architects as $architect) {
                $architect->notify(
                    Notification::make()
                        ->title('New Project created Title: ' . $project->title)
                        ->toDatabase()
                );
            }
            return $project;
        });
    }

    /**
     * Get the value of the model's route key.
     */
    public function getRouteKey(): mixed
    {
        return $this->slug;
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Scope a query to only include projects the user can view.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  \App\Models\User  $user
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVisibleTo(Builder $query, User $user): Builder
    {
        if ($user->isAdmin()) {
            return $query;
        }

        if ($user->isClient()) {
            return $query->where('client_id', $user->client->id);
        }

        if ($user->isArchitect()) {
            return $query->where(function (Builder $query) use ($user) {
                $query->whereNull('architect_id')
                    ->orWhere('architect_id', $user->architect->id);
            });
        }

        return $query->where('id', -1);
    }

    /**
     * Get all of the projects for the Project
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    /**
     * Get all of the messages for the Project
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function lastMessage()
    {
        return $this->hasOne(Message::class)->latest();
    }
}
