<?php

// Home page
$app->get('/', 'Teammanager\Controller\IndexController::indexAction');

// Teams list
$app->get('/teams', 'Teammanager\Controller\TeamController::listAction');

// Teammates list
$app->get('/teammates', 'Teammanager\Controller\TeammateController::listAction');

// Team detail
$app->get('/team/{id}', 'Teammanager\Controller\TeamController::displayAction');

// Teammate detail
$app->get('/teammate/{id}', 'Teammanager\Controller\TeammateController::displayAction');
