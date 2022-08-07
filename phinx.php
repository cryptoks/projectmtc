<?php
require_once(__DIR__ . "/vendor/autoload.php");
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$dotenv->required(
    [
        'DATABASE_HOST',
        'DATABASE_USERNAME',
        'DATABASE_NAME',
        'DATABASE_PORT'
    ]
)->notEmpty();
$dotenv->required('DATABASE_PASSWORD');

return
    [
        'paths' => [
            'migrations' => '%%PHINX_CONFIG_DIR%%/Database/Migrations',
            'seeds' => '%%PHINX_CONFIG_DIR%%/Database/Seeds'
        ],
        'environments' => [
            'default_migration_table' => 'phinxlog',
            'default_environment' => 'development',
            'production' => [
                'adapter' => 'mysql',
                'host' => $_ENV['DATABASE_HOST'],
                'name' => $_ENV['DATABASE_NAME'],
                'user' => $_ENV['DATABASE_USERNAME'],
                'pass' => $_ENV['DATABASE_PASSWORD'],
                'port' => $_ENV['DATABASE_PORT'],
                'charset' => 'utf8',
            ],
            'development' => [
                'adapter' => 'mysql',
                'host' => $_ENV['DATABASE_HOST'],
                'name' => $_ENV['DATABASE_NAME'],
                'user' => $_ENV['DATABASE_USERNAME'],
                'pass' => $_ENV['DATABASE_PASSWORD'],
                'port' => $_ENV['DATABASE_PORT'],
                'charset' => 'utf8',
            ],
            'testing' => [
                'adapter' => 'mysql',
                'host' => $_ENV['DATABASE_HOST'],
                'name' => $_ENV['DATABASE_NAME'],
                'user' => $_ENV['DATABASE_USERNAME'],
                'pass' => $_ENV['DATABASE_PASSWORD'],
                'port' => $_ENV['DATABASE_PORT'],
                'charset' => 'utf8',
            ]
        ],
        'version_order' => 'creation'
    ];
