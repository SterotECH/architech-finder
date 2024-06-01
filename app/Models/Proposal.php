<?php

namespace App\Models;

use App\Enums\ProposalStatus;
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
        $sql = "SELECT
                p.*,
                av.first_name,
                av.last_name,
                av.avatar
            FROM proposals p
            JOIN architects_view av ON p.architect_id = av.architect_id
            WHERE p.project_id = :id";

        return self::raw($sql, ['id' => $id]);
    }

    public static function rejectOtherProposals($project_id, $accepted_proposal_id): bool
    {
        $proposals = self::where('project_id', $project_id)->get(['id', 'status']);
        foreach ($proposals as $proposal) {
            if ($proposal->id != $accepted_proposal_id) {
                $proposal = new self();
                $proposal->status = ProposalStatus::REJECTED->value;
                $proposal->save();
            }
        }
        return true;
    }
}
