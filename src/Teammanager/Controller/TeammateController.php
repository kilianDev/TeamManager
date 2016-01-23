<?php

namespace Teammanager\Controller;


use Silex\Application;
use Silex\Controller;
use Symfony\Component\HttpFoundation\Request;
use Teammanager\Form\TeammateType;
use Teammanager\Model\Teammate;

class TeammateController {

    public function listAction(Application $app)
    {
        $data = array();

        return $app['twig']->render('teammate/teammates.html.twig', $data);
    }

    public function displayAction(Application $app, $id)
    {
        $teammate = $app['repository.teammate']->find($id);

        if (!$teammate) {
            return $app['twig']->render('teammate/teammateNotFound.html.twig', array());
        }
        $data = array(
            'teammate' => $teammate,
            'id' => $id
        );

        return $app['twig']->render('teammate/teammate.html.twig', $data);
    }

    public function createAction(Application $app, Request $request)
    {
        $teammate = new Teammate();
        $form = $app['form.factory']->create(new TeammateType(), $teammate);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $app['repository.teammate']->save($teammate);
            $app['session']->getFlashBag()->add('success', 'Teammate has been added.');
            return $app['twig']->render('teammate/successCreateTeammate.html.twig', array());
        }

        // display the form
        return $app['twig']->render('teammate/createTeammate.html.twig', array('form' => $form->createView()));

    }
}