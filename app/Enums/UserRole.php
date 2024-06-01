<?php
namespace App\Enums;

enum UserRole: string
{
    case ADMINISTRATOR = 'Administrator';
    case CLIENT = 'Client';
    case ARCHITECT = 'Architect';
}
