<?php

namespace App\Models;

use AllowDynamicProperties;
use DateTime;

#[AllowDynamicProperties] class User extends Model
{
    protected static ?string $table = 'users';

    protected static array $fields = [
        'id',
        'email',
        'first_name',
        'last_name',
        'phone_number',
        'avatar',
        'role',
        'created_at',
    ];

    public int $id;
    public string $email;
    public string $first_name;
    public string $last_name;
    public string $phone_number;
    public string $password;
    public DateTime $updated_at;
    public DateTime $created_at;

    const CLIENT_ROLE = 'Client';
    public const ARCHITECT_ROLE = 'Architect';

}
