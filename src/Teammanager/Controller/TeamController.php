<?

namespace Teammanager\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Teammanager\Form\TeamType;
use Teammanager\Model\Team;
use Teammanager\Model\Teammate;

/**
 * Class TeamController
 * @package Teammanager\Controller
 */
class TeamController
{
    /**
     * @param Application $app
     * @return mixed
     */
    public function listAction(Application $app)
    {
        $teams = $app['repository.team']->findAll();

        $data = array(
            'teams' => $teams
        );

        return $app['twig']->render('team/teams.html.twig', $data);
    }

    /**
     * @param Application $app
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function editAction(Application $app, Request $request, $id)
    {
        /** @var Team $team */
        $team = $app['repository.team']->find($id);

        if (!$team) {
            return $app['twig']->render('team/teamNotFound.html.twig', array());
        }

        $teammates = $app['repository.teammate']->findAll();

        $teamTeammates = $team->getTeammates();
        $selectedTeammates = array();
        foreach ($teamTeammates as $team_has_teammate) {
            $selectedTeammates[] = $team_has_teammate['teammate_id'];
        }

        $choicesTeammates = array();

        /** @var Teammate $teammate */
        foreach ($teammates as $teammate) {
            $choicesTeammates[$teammate->getId()] = $teammate->getFirstAndLastName();
        }

        $form = $app['form.factory']->create(new TeamType($choicesTeammates, $selectedTeammates), $team);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $app['repository.team']->save($team);
            $app['session']->getFlashBag()->add('success', 'Team has been modified.');
            return $app->redirect('/teammanager/web/teams');
        }

        // display the form
        return $app['twig']->render('team/formTeam.html.twig', array('form' => $form->createView()));
    }

    /**
     * @param Application $app
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function createAction(Application $app, Request $request)
    {
        $team = new Team();
        $teammates = $app['repository.teammate']->findAll();

        $choicesTeammates = array();

        /** @var Teammate $teammate */
        foreach ($teammates as $teammate) {
            $choicesTeammates[$teammate->getId()] = $teammate->getFirstAndLastName();
        }

        $form = $app['form.factory']->create(new TeamType($choicesTeammates), $team);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $app['repository.team']->save($team);
            $app['session']->getFlashBag()->add('success', 'Team has been added.');
            return $app->redirect('/teammanager/web/teams');
        }

        // display the form
        return $app['twig']->render('team/formTeam.html.twig', array('form' => $form->createView()));

    }

    /**
     * @param Application $app
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Application $app, $id)
    {
        $app['repository.team']->delete($id);

        $app['session']->getFlashBag()->add('success', 'Team has been deleted.');
        return $app->redirect('/teammanager/web/teams');
    }
}