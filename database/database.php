<?php
function getPDO():PDO|null
{
    define('DR', $_SERVER['DOCUMENT_ROOT']);
    $config = parse_ini_file(DR . '/.env.local.ini', true);

    $dsn = sprintf('%s:host=%s;port=%s;dbname=%s',
        $config['database']['DB_DRIVER'],
        $config['database']['DB_HOST'],
        $config['database']['DB_PORT'],
        $config['database']['DB_NAME'],
    );

    $username = $config['database']['DB_USERNAME'];
    $password = $config['database']['DB_PASSWORD'];
    $options = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ];

    try {

        $db = new PDO($dsn, $username, $password, $options);
    } catch (PDOException $exception) {
        die('Accès à la base de données impossible');
    }
    return $db;
}