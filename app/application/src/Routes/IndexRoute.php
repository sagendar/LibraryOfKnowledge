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
class IndexRoute extends AbstractRoutes
{
    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     */
    function __invoke(Request $request, Response $response, array $args)
    {
        parent::__invoke($request, $response, $args);
        $this->indexAction();
    }

    public function indexAction()
    {
        $controller = new Controller\IndexController($this->container);
        $recentPosts = $controller->getRecentPosts();
        $displayedPosts = $controller->getPosts();

        $user = [];

        $usercontroller = new Controller\UserController($this->container);

        $user = $usercontroller->isLoggedIn();

        $this->renderView($recentPosts, $displayedPosts, $user);
    }

    private function renderView($recentPosts, $displayedPosts, $user)
    {
        return $this->container->view->render(
            $this->response,
            'displayPosts.twig',
            [
                'recentPosts' => $recentPosts,
                'displayedPosts' => $displayedPosts,
                'user' => $user
            ]
        );
    }
}
