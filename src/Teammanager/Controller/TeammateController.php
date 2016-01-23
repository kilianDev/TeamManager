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
        $teammate = $app['repository.teammate']->find($id);

        if (!$teammate) {
            return $app['twig']->render('teammateNotFound.html.twig', array());
        }
        $data = array(
            'teammate' => $teammate,
            'id' => $id
        );

        return $app['twig']->render('teammate.html.twig', $data);
    }
}