<?php


namespace Routes;

use \flight;


class PublicRoutes
{

    private static $prefix = "";

    public static function init()
    {
        $controller = new \Controllers\PublicController;
        $base = self::$prefix;

        flight::route("GET {$base}/ping", [$controller, "pong"]);

        flight::route("GET " . $base . "/*", [$controller, "index"]);
    }
}
