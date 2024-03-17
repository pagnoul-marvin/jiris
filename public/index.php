<?php

use Core\Router;

const BASE_PATH = __DIR__.'/..';
require BASE_PATH.'/core/helpers/functions.php';
require base_path('vendor/autoload.php');

$router = new Router();
require base_path('routes/web.php');


$request_method = $_SERVER['REQUEST_METHOD'];
$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$router->route_to_controller($request_method, $request_uri);