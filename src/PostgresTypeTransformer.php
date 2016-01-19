<?php

namespace Aejnsn\LaravelPostgresify;

use Aejnsn\LaravelPostgresify\Types\Point;

class PostgresifyTypeTransformer
{
    public static $validTypes = [
        'ipAddress',
        'netmask',
        'macAddress',
        'point',
        'line',
    ];

    public static function transform($key, $value, $typeInformation)
    {
        $transformMethod = 'transform' . ucfirst($typeInformation['type']);
        return self::$transformMethod($key, $value, $typeInformation);
    }

    public static function transformPoint($key, $value, $typeInformation)
    {
        preg_match_all("/-?\d+\.\d+/", $value, $matches);
        $point = new Point(floatval($matches[0][0]), floatval($matches[0][1]));
        return $point;
    }
}
