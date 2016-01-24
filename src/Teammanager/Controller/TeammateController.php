<?php

namespace Teammanager\Controller;


use Silex\Application;
use Silex\Controller;
use Symfony\Component\HttpFoundation\Request;
use Teammanager\Form\TeammateType;
use Teammanager\Model\Teammate;

/**
 * Class TeammateController
 * @package Teammanager\Controller
 */
class TeammateController
{
    /**
     * @param Application $app
     * @return mixed
     */
    public function listAction(Application $app)
    {
        $teammates = $app['repository.teammate']->findAll();

        $data = array(
            'teammates' => $teammates
        );

        return $app['twig']->render('teammate/teammates.html.twig', $data);
    }

    /**
     * @param Application $app
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function editAction(Application $app, Request $request, $id)
    {
        /** @var Teammate $teammate */
        $teammate = $app['repository.teammate']->find($id);

        if (!$teammate) {
            return $app['twig']->render('teammate/teammateNotFound.html.twig', array());
        }

        $form = $app['form.factory']->create(new TeammateType(), $teammate);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $app['repository.teammate']->save($teammate);
            $app['session']->getFlashBag()->add('success', 'Teammate has been modified.');
            return $app->redirect('/teammanager/web/teammates');
        }


        // display the form
        return $app['twig']->render('teammate/formTeammate.html.twig', array('form' => $form->createView()));
    }

    /**
     * @param Application $app
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function createAction(Application $app, Request $request)
    {
        $teammate = new Teammate();
        $form = $app['form.factory']->create(new TeammateType(), $teammate);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $app['repository.teammate']->save($teammate);
            $app['session']->getFlashBag()->add('success', 'Teammate has been added.');
            return $app->redirect('/teammanager/web/teammates');
        }

        // display the form
        return $app['twig']->render('teammate/formTeammate.html.twig', array('form' => $form->createView()));

    }

    /**
     * @param Application $app
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Application $app, $id)
    {
        $app['repository.teammate']->delete($id);

        $app['session']->getFlashBag()->add('success', 'Teammate has been deleted.');
        return $app->redirect('/teammanager/web/teammates');
    }
}