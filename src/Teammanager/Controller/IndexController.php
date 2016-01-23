<?php

namespace Teammanager\Controller;


use Silex\Application;

class IndexController {

    public function indexAction(Application $app)
    {
        $data = array();

        // Home page
        return $app['twig']->render('index.html.twig', $data);

    }

}