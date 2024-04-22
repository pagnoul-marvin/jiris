<?php

// Get a connection to Db
use Core\Exceptions\FileNotFoundException;

try {
    $db = new Core\Database(BASE_PATH.'/.env.local.ini');
} catch (FileNotFoundException $exception) {
    exit($exception->getMessage());
}

// Drop tables
echo 'Dropping all Tables'.PHP_EOL;
$db->dropTables();
echo 'All tables have been dropped'.PHP_EOL;

// Create tables

echo 'Creating Jiri table'.PHP_EOL;
$create_user_table_sql = <<<'SQL'
    create table jiris
    (
        id          int auto_increment
            primary key,
        name        varchar(255)                        not null,
        starting_at timestamp                           not null comment 'Indicates the moment the jiri should start',
        created_at  timestamp default CURRENT_TIMESTAMP null,
        updated_at  timestamp default CURRENT_TIMESTAMP null on update CURRENT_TIMESTAMP
    );
SQL;

$db->exec($create_user_table_sql);
echo 'Jiri table created'.PHP_EOL;

echo 'Creating User table'.PHP_EOL;
$create_user_table_sql = <<<'SQL'
    create table users
    (
        id int auto_increment primary key,
        name varchar(255),
        email varchar(255) not null unique,
        password varchar(255) not null,
        created_at  timestamp default CURRENT_TIMESTAMP null,
        updated_at  timestamp default CURRENT_TIMESTAMP null on update CURRENT_TIMESTAMP
    );
SQL;

$db->exec($create_user_table_sql);
echo 'User table created'.PHP_EOL;
