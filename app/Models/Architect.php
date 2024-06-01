<?php

namespace App\Models;

class Architect extends Model
{

    protected static array $fields = [
        'id', 'user_id', 'experience', 'qualifications', 'portfolio_link', 'biography'
    ];

    public int $id;
    public int $user_id;
    public string $experience;
    public string $qualifications;
    public string $portfolio_link;
    public string $biography;

    public static function getArchitectWithProfile(): array
    {
        $sql = "SELECT a.*,
            av.first_name,
            av.last_name,
            av.email,
            av.avatar
            FROM architects a
            INNER JOIN architects_view av ON a.user_id = av.id
        ";
        return self::raw($sql);
    }

    public static function architectProfileView(string|int $id): object
    {
        $sql = "SELECT
        a.*,
        CONCAT(av.first_name, ' ', av.last_name) AS name,
        av.email,
        av.avatar,
        av.phone_number,
        av.gender,
        av.location
        FROM architects a
        INNER JOIN architects_view av ON a.user_id = av.id
        WHERE a.id = ?
        ";
        self::init();
        return self::$database->query($sql, [$id])->findOrFail();
    }

}
