<?php

namespace Teammanager\Controller;


use Silex\Application;

class IndexController {

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