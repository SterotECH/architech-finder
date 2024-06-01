<?php

namespace App\Models;

use App\Core\Database;


#[\AllowDynamicProperties]
class Model
{
    use \App\Traits\Model;

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
