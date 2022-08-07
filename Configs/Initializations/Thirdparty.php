<?php

//DotENV Library
$dotenv = Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT']);
$dotenv->load();
$dotenv->required(
    [
        'DATABASE_HOST',
        'DATABASE_USERNAME',
        'DATABASE_NAME',
        'DATABASE_PORT',
        'API_KEY'
    ]
)->notEmpty();
$dotenv->required('DATABASE_PASSWORD');
$dotenv->required('SITE_STATUS')->allowedValues(['development', 'production']);
