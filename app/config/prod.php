<?php

// Timezone.
date_default_timezone_set('Europe/Paris');

$app['upload_folder']=__DIR__ . '/web/uploads';

// Doctrine (db)
$app['db.options'] = array(
    'driver'   => 'pdo_mysql',
    'host'     => 'localhost',
    'port'     => '3306',
    'dbname'   => 'teammanager',
    'user'     => 'root',
    'password' => 'root',
);
