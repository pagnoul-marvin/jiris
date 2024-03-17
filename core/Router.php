<?php

namespace Core;

class Router
{
    private array $routes;

    public function get(string $path, array $action): void
    {
        $this->add($path, $action, 'GET');
    }

    public function post(string $path, array $action): void
    {
        $this->add($path, $action, 'POST');
    }

    private function add(string $path, array $action, string $request_method): void
    {
        $this->routes[] = compact('path', 'action', 'request_method');
    }

    public function route_to_controller(mixed $request_method, string $request_uri): void
    {
        $action =
            array_values(
                array_filter(
                    $this->routes,
                    fn($v, $k) => $v['path'] === $request_uri && $v['request_method'] === $request_method,
                    ARRAY_FILTER_USE_BOTH
                )
            );

        if (empty($action)) {
            Response::abort();
        }

        $action = $action[0]['action'];

        [$controller_name, $method_name] = $action;

        $controller = new $controller_name();
        $controller->{$method_name}();
    }
}