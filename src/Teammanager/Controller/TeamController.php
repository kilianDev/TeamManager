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
        $data = array(
            'id' => $id
        );

        return $app['twig']->render('team.html.twig', $data);
    }
}