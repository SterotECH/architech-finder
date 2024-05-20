<?php

namespace App\Models;

class Architect extends Model
{

    protected static array $fields = [
        'id', 'user_id', 'experience', 'qualification', 'portfolio_link', 'biography'
    ];

    public int $id;
    public int $user_id;
    public string $experience;
    public string $qualification;
    public string $portfolio_link;
    public string $biography;

}
