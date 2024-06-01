<?php

namespace App\Models;

use App\Enums\ProjectStatus;
use App\Enums\ProjectType;
use DateTime;

class Project extends Model
{
    public int $id;
    public int $client_id;
    public string $title;
    public string $slug;
    public string $description;
    public string|ProjectStatus $status;
    public string|ProjectType $type;
    public float $budget;
    public ?DateTime $created_at;
    public ?DateTime $updated_at;
    public ?DateTime $deleted_at;
    public ?DateTime $completed_at;
    public ?DateTime $cancelled_at;

    protected static array $fields = [
        'id', 'client_id', 'title', 'slug', 'description', 'status',  'type'
    ];

    public static function getProjectDetails(string|int $id): array
    {
        $sql = "SELECT
            projects.id, projects.client_id, projects.title, projects.slug
            projects.description, projects.status, projects.type,
            attachments.file_name, attachments.file_path, attachments.file_type
        FROM projects
        INNER JOIN attachments.project_id ON projects.id
        WHERE projects.id = :id";
        return self::raw($sql, ['id' => $id]);
    }

    public function save(): object
    {
        $this->status = $this->status->value;
        $this->type = $this->type->value;
        return parent::save();
    }

    /**
     * Get all projects with corresponding client details.
     *
     * @return array
     */
    public function getAllProjectsWithClients(): array
    {
        $sql = "
            SELECT
                p.*,
                cv.first_name,
                cv.last_name,
                cv.avatar,
                cv.email,
                cv.location,
                cv.phone_number,
                cv.gender,
                cv.role,
                cv.address
            FROM
                projects p
            JOIN
                clients_view cv
            ON
                p.client_id = cv.id";

        return self::raw($sql);
    }
}
