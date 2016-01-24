<?php

namespace Teammanager\Controller;


use Silex\Application;

/**
 * Class IndexController
 * @package Teammanager\Controller
 */
class IndexController
{

    /**
     * @param Application $app
     * @return mixed
     */
    public function indexAction(Application $app)
    {
        $data = array();

        $teamsCount = $app['repository.team']->getCount();
        $teammatesCount = $app['repository.teammate']->getCount();

        $data['teamsCount'] = $teamsCount;
        $data['teammatesCount'] = $teammatesCount;

        // Home page
        return $app['twig']->render('index.html.twig', $data);

    }

}