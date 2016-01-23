<?php

namespace Teammanager\Controller;


use Silex\Application;

class TeammateController {

    public function listAction(Application $app)
    {
        $data = array();

        return $app['twig']->render('teammates.html.twig', $data);
    }

    public function displayAction(Application $app, $id)
    {
        $data = array(
            'id' => $id
        );

        return $app['twig']->render('teammate.html.twig', $data);
    }
}