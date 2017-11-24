<?php

namespace M151\LibraryOK\Routes;

use Slim\Http\Request;
use Slim\Http\Response;
use M151\LibraryOK\Model;
use M151\LibraryOK\Routes;
use M151\LibraryOK\Controller;

/**
 * Class IndexRoute
 * @package M151\LibraryOK\Routes
 */
class LoginRoute extends AbstractRoutes
{
    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     */
    function __invoke(Request $request, Response $response, array $args)
    {
        parent::__invoke($request, $response, $args);
        return $this->loginAction();

    }

    public function loginAction()
    {
        $controller = new Controller\PostController($this->container);
        $recentPosts = $controller->getRecentPosts();

        $usercontroller = new Controller\UserController($this->container);

        $user = [];

        if(!isset($_POST['username'])) {
            $this->renderView($recentPosts, $user, "login");
            return;
        }

        $response = $usercontroller->login($_POST);

        if($response == false) {
            $this->renderView($recentPosts, $user, "login");
        } else {
            $uri = $this->request->getUri()->withPath("/");
            return $this->response->withRedirect((string)$uri);
        }
    }

    /**
     * @param $recentPosts
     * @return mixed
     */
    private function renderView($recentPosts, $user, $page, $displayedPosts = null)
    {
        return $this->container->view->render(
            $this->response,
            $page . '.twig',
            [
                'recentPosts' => $recentPosts,
                'current' => 'profil',
                'user' => $user,
                'displayedPosts' => $displayedPosts
            ]
        );
    }
}
