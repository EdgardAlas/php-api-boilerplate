<?php

namespace Controllers;

use Flight;

class PublicController
{
    public static function index()
    {

        /* Getting the root of the project and then getting the url of the file that is being requested. */
        $current_root = explode("\\", dirname(__FILE__));
        array_pop($current_root);
        $root = ((implode("\\", $current_root)));
        $url =  $root . "\\public" . str_replace(getenv("URL_REMOVE"), "", $_SERVER['REQUEST_URI']);
        $url = str_replace("/", "\\", $url);
        $urlExploded = explode("\\", $url);


        /* This is checking if the url is the root of the website. If it is, it will return the
       index.html file. */
        if ($_SERVER['REQUEST_URI'] === "/") {
            readfile($root . "/public/index.html");
            exit();
        }

        /* This is checking if the url contains "../". If it does, it will return a 404 error. */
        if (str_contains($url, "../")) {
            Flight::error();
            exit();
        }

        /* Getting the filename of the file that is being requested. */
        $filename = $urlExploded[sizeof($urlExploded) - 1];

        /* This is checking if the file exists and if it does not end with .html. If it does, it will
      return the file. */
        if (file_exists($url) && !str_ends_with($url, ".html")) {
            header("Content-type: application/octet-stream");
            header("Content-disposition: attachment;filename=" . $filename);
            readfile($url);
            exit();
        }

        /* This is checking if the file does not exist and if it ends with .html. If it does, it will
       return a 404 error. */
        if (!file_exists($url) && str_ends_with($url, ".html") && sizeof($urlExploded) > 0) {
            Flight::notFound();
            exit();
        }


        readfile($root . "/public/index.html");
        exit();
    }

    public static function pong()
    {
        echo "pong";
        exit();
    }
}
