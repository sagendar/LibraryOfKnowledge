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
class SingleUserRoute extends AbstractRoutes
{
    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     */
    function __invoke(Request $request, Response $response, array $args)
    {
        parent::__invoke($request, $response, $args);
        $this->singleUserAction();
    }

    public function singleUserAction()
    {
        $controller = new Controller\PostController($this->container);
        $recentPosts = $controller->getRecentPosts();



        $usercontroller = new Controller\UserController($this->container);

        $user = $usercontroller->getUser();

        print_r($user);

        $userInfo = $usercontroller->isLoggedIn();

        $this->renderView($recentPosts, $userInfo, $user);
    }

    private function renderView($recentPosts, $userInfo, $user)
    {
        return $this->container->view->render(
            $this->response,
            'singleUser.twig',
            [
                'recentPosts' => $recentPosts,
                'user' => $userInfo,
                'users' => $user[0]
            ]
        );
    }
}
