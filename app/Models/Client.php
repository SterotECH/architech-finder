<?php

namespace App\Models;

class Client extends Model
{

    protected static array $fields = [
        'id', 'user_id', 'address'
    ];

    public int $id;
    public int $user_id;
    public string $address;

    public function user(int|string $id = null)
    {
        $query = "
            SELECT users.id AS user_id,
            CONCAT(users.first_name, ' ', users.last_name) AS name,
            users.email, users.phone_number, users.gender, users.avatar,
            users.location, users.role, clients.address,
            clients.id AS client_id
            FROM clients
            INNER JOIN users ON clients.user_id = users.id
            WHERE id = :id
        ";
        return $this->raw($query, ['id' => $id]);
    }

}
