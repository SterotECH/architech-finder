<?php

namespace App\Models;

use DateTime;

class Proposal extends Model
{
    public int $id;
    public int $project_id;
    public int $architect_id;
    public string $approach;
    public string $timeline;
    public float $fees;
    public DateTime $submitted_at;


    protected static array $fields = [
        'id', 'project_id', 'architect_id', 'approach', 'timeline', 'fees', 'submitted_at'
    ];

    public static function proposalWithArchitectsDetails(string|int $id): array
    {
        // $sql = "SELECT
        //     p.*,
        //     av.first_name,
        //     av.last_name
        //     FROM proposals p
        //     JOIN architects_view av ON p.architect_id = av.architect_id
        //     WHERE p.project_id = :id";

        return self::$database->query("SELECT  * FROM proposals WHERE project_id = :id", ['id' => $id])->findAll();
    }
}
