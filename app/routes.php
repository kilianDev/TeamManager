<?php

// Home page
$app->get('/', 'Teammanager\Controller\IndexController::indexAction');

// Teams list
$app->get('/teams', 'Teammanager\Controller\TeamController::listAction');

// Teammates list
$app->get('/teammates', 'Teammanager\Controller\TeammateController::listAction')
    ->bind('teammates');

// Team create
$app->match('/team/create', 'Teammanager\Controller\TeamController::createAction');

// Team deletion
$app->match('/team/{id}/delete', 'Teammanager\Controller\TeamController::deleteAction')
    ->assert('id', '\d+');

// Team detail
$app->match('/team/{id}', 'Teammanager\Controller\TeamController::editAction')
    ->assert('id', '\d+');

// Teammate create
$app->match('/teammate/create', 'Teammanager\Controller\TeammateController::createAction');

// Teammate deletion
$app->match('/teammate/{id}/delete', 'Teammanager\Controller\TeammateController::deleteAction')
    ->assert('id', '\d+');

// Teammate detail
$app->match('/teammate/{id}', 'Teammanager\Controller\TeammateController::editAction')
    ->assert('id', '\d+');
