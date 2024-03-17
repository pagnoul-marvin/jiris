<?php

use JetBrains\PhpStorm\NoReturn;

#[NoReturn] function dd(mixed ...$vars): void
{
    foreach ($vars as $var) {
        var_dump($var);
        echo '<hr>';
    }
    die();
}


function view(string $path, array $data = []): void
{
    extract($data);

    $fragments = explode('.', $path);

    require base_path("resources/views/{$fragments[0]}/{$fragments[1]}.view.php");
}

function base_path(string $path = ''): string
{
    return BASE_PATH."/{$path}";
}