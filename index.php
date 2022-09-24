<?php

require __DIR__ . "/config/cors.php";
require __DIR__ . "/libs/flight/Flight.php";
require __DIR__ . '/Loader.php';

Loader::init();
(new \Libs\DotEnv(__DIR__ . '/.env'))->load();


\Database\DB::init();
\Routes\RouteRequire::init();



Flight::start();
