<?php

use Silex\Provider\TwigServiceProvider;

// Register service providers.
$app->register(new Silex\Provider\DoctrineServiceProvider());

$app->register(new TwigServiceProvider(), array(
    'twig.path' => '../views',
));

