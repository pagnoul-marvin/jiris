<?php

use Core\Router;
use App\Http\controllers\ProfileController;

/** @var Router $router */

$router->get('/profile/edit', [ProfileController::class, 'edit'])->only('auth');

$router->patch('/profile', [ProfileController::class, 'update'])->only('auth')->csrf();