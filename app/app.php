<?php

use Silex\Provider\TwigServiceProvider;

// Register repositories.
$app['repository.team'] = $app->share(function ($app) {
    return new Teammanager\Repository\TeamRepository($app['db']);
});
$app['repository.teammate'] = $app->share(function ($app) {
    return new Teammanager\Repository\TeammateRepository($app['db']);
});

// Register service providers.
$app->register(new Silex\Provider\DoctrineServiceProvider());

$app->register(new TwigServiceProvider(), array(
    'twig.path' => '../views',
));

