<?php

class ArchitectView
{
    public function up(): string
    {
        return "
        CREATE VIEW architects_view AS
        SELECT
            users.id,
            users.first_name,
            users.last_name,
            users.avatar,
            users.email,
            users.location,
            users.phone_number,
            users.gender,
            users.role,
            architects.id AS architect_id,
            architects.experience,
            architects.biography,
            architects.qualifications,
            architects.portfolio_link,
            architects.created_at,
            architects.updated_at
        FROM architects
        JOIN users ON architects.user_id = users.id;";
    }

    public function down(): string
    {
        return "DROP VIEW architects_view;";
    }
}
