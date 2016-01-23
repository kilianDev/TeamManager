<?

namespace Teammanager\Controller;

use Silex\Application;

class TeamController
{

    public function listAction(Application $app)
    {
        $data = array();

        return $app['twig']->render('teams.html.twig', $data);
    }

    public function displayAction(Application $app, $id)
    {
        $team = $app['repository.team']->find($id);

        if (!$team) {
            return $app['twig']->render('teamNotFound.html.twig', array());
        }
        $data = array(
            'team' => $team,
            'id' => $id
        );

        return $app['twig']->render('team.html.twig', $data);
    }
}