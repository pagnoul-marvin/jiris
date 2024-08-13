<?php
/*

use App\Http\Controllers\ProjectController;

/** @var \Core\Router $router
$router->get('/projects', [ProjectController::class, 'index'])->only('auth');

$router->get('/project/create', [ProjectController::class, 'create'])->only('auth');
$router->post('/project', [ProjectController::class, 'store'])->only('auth')->csrf();

$router->get('/project', [ProjectController::class, 'show'])->only('auth');

$router->get('/project/edit', [ProjectController::class, 'edit'])->only('auth');
$router->patch('/project', [ProjectController::class, 'update'])->only('auth')->csrf();

$router->delete('/project', [ProjectController::class, 'destroy'])->only('auth')->csrf();
*/

use App\Http\controllers\ProjectController;
use Core\Router;

/** @var Router $router */
$router->get('/projects', [ProjectController::class, 'index'])->only('auth');

$router->get('/project', [ProjectController::class, 'show'])->only('auth');

$router->delete('/project', [ProjectController::class, 'destroy'])->only('auth')->csrf();

$router->get('/project/create', [ProjectController::class, 'create'])->only('auth');
$router->post('/project', [ProjectController::class, 'store'])->only('auth')->csrf();