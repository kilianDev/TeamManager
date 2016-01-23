<?php

// Home page
$app->get('/', function () use ($app) {
  return $app['twig']->render('home.twig', array());
});

// Teams list
$app->get('/teams', function () use ($app) {
    return $app['twig']->render('teams.twig', array());
});

// Teammates list
$app->get('/teammates', function () use ($app) {
    return $app['twig']->render('teammates.twig', array());
});

// Team detail
$app->get('/team/{id}', function ($id) use ($app) {
    return $app['twig']->render('team.twig', array(
        'id' => $id
    ));
});

// Teammate detail
$app->get('/teammate/{id}', function ($id) use ($app) {
    return $app['twig']->render('teammate.twig', array(
        'id' => $id
    ));
});
