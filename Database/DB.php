<?php

namespace Database;

use \PDO;

class DB
{
    /**
     * It creates a PDO object and registers it as a Flight component.
     * 
     * The first argument is the name of the component. The second argument is the class name. The third
     * argument is an array of arguments to pass to the constructor. The fourth argument is a callback
     * function that will be called after the object is created.
     * 
     * The callback function sets the error mode to throw exceptions.
     */
    public static function init()
    {
        \flight::register(
            'db',
            'PDO',
            array(
                'mysql:host=' . getenv("DB_HOST") . ';dbname=' . getenv("DB_NAME"),
                getenv("DB_USER"),
                getenv("DB_PASSWORD")
            ),
            function ($db) {
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
        );
    }
}
