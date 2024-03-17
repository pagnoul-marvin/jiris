<?php

use App\Http\Controllers\JiriController;

/** @var Core\Router $router */
$router->get('/', [JiriController::class, 'index']);//done

$router->get('/jiris', [JiriController::class, 'index']);//done

$router->get('/jiri', [JiriController::class, 'show']);//done

$router->get('/jiri/create', [JiriController::class, 'create']);//done
$router->post('/jiri', [JiriController::class, 'store']);//done

$router->get('/jiri/edit', [JiriController::class, 'edit']);
$router->post('/jiri/update', [JiriController::class, 'update']);


$router->post('/jiri/delete', [JiriController::class, 'destroy']);//done