<?

namespace Teammanager\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Teammanager\Form\TeamType;
use Teammanager\Model\Team;

class TeamController
{

    public function listAction(Application $app)
    {
        $data = array();

        return $app['twig']->render('team/teams.html.twig', $data);
    }

    public function displayAction(Application $app, $id)
    {
        $team = $app['repository.team']->find($id);

        if (!$team) {
            return $app['twig']->render('team/teamNotFound.html.twig', array());
        }
        $data = array(
            'team' => $team,
            'id' => $id
        );

        return $app['twig']->render('team/team.html.twig', $data);
    }

    public function createAction(Application $app, Request $request)
    {
        $team = new Team();
        $form = $app['form.factory']->create(new TeamType(), $team);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $app['repository.team']->save($team);
            $app['session']->getFlashBag()->add('success', 'Team has been added.');
            return $app['twig']->render('team/successCreateteam.html.twig', array());
        }

        // display the form
        return $app['twig']->render('team/createteam.html.twig', array('form' => $form->createView()));

    }
}