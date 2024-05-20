<?php

namespace App\Models;



class Model
{
    use \App\Traits\Model;

    protected static Database $database;

    /**
     * Initialize the database connection.
     */
    public static function init(): void
    {
        self::$database = Database::getInstance();
    }

    /**
     * @return string
     */
    public static function getTableName(): string
    {
        $className = static::class;
        $parts = explode('\\', $className);
        $className = end($parts);
        $className = strtolower($className);
        $last = strtolower($className[strlen($className) - 1]);
        return match ($last) {
            'y' => substr($className, 0, -1) . 'ies',
            's' => $className . 'es',
            default => $className . 's',
        };
    }
}
