<?php

class ClientView
{
    public function up(): string
    {
        return "CREATE VIEW clients_view AS
        SELECT
            users.first_name,
            users.last_name,
            users.avatar,
            users.email,
            users.location,
            users.phone_number,
            users.gender,
            users.role,
            clients.address,
            clients.id,
            clients.user_id
        FROM clients
        JOIN users ON clients.user_id = users.id;";
    }

    public function down(): string
    {
        return "DROP VIEW clients_view;";
    }
}
