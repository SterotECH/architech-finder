<?php

namespace App\Core;

class Logger
{
    /**
     * Logs any type of data to the server logs.
     *
     * @param mixed $data The data to log.
     * @return void
     */
    public static function log($data): void
    {
        error_log(self::formatData($data));
    }

    /**
     * Formats the data for logging.
     *
     * @param mixed $data The data to format.
     * @return string The formatted data as a string.
     */
    private static function formatData($data): string
    {
        return match (gettype($data)) {
            'array' => self::formatArray($data),
            'object' => self::formatObject($data),
            'boolean' => $data ? 'true' : 'false',
            'NULL' => 'null',
            default => (string) $data,
        };
    }

    /**
     * Formats an array for logging.
     *
     * @param array $array The array to format.
     * @return string The formatted array as a string.
     */
    private static function formatArray(array $array): string
    {
        return json_encode($array, JSON_PRETTY_PRINT);
    }

    /**
     * Formats an object for logging.
     *
     * @param object $object The object to format.
     * @return string The formatted object as a string.
     */
    private static function formatObject(object $object): string
    {
        $array = self::objectToArray($object);
        return json_encode($array, JSON_PRETTY_PRINT);
    }

    /**
     * Converts an object to an array recursively.
     *
     * @param object $object The object to convert.
     * @return array The object converted to an array.
     * @throws \UnexpectedValueException If conversion fails.
     */
    private static function objectToArray(object $object): array
    {
        $array = [];
        foreach (get_object_vars($object) as $key => $value) {
            if (is_object($value)) {
                if ($value instanceof \UnitEnum) {
                    // Convert enum to its value
                    $array[$key] = $value->value;
                } else {
                    // Recursively convert nested objects
                    $array[$key] = self::objectToArray($value);
                }
            } else {
                $array[$key] = $value;
            }
        }

        return $array;
    }
}
