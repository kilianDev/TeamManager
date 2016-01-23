<?php

// Home page
$app->get('/', 'Teammanager\Controller\IndexController::indexAction');

// Teams list
$app->get('/teams', function () use ($app) {
    return $app['twig']->render('teams.html.twig', array());
});

// Teammates list
$app->get('/teammates', function () use ($app) {
    return $app['twig']->render('teammates.html.twig', array());
});

// Team detail
$app->get('/team/{id}', function ($id) use ($app) {
    return $app['twig']->render('team.html.twig', array(
        'id' => $id
    ));
});

// Teammate detail
$app->get('/teammate/{id}', function ($id) use ($app) {
    return $app['twig']->render('teammate.html.twig', array(
        'id' => $id
    ));
});
