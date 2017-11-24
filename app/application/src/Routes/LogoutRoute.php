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
class LogoutRoute extends AbstractRoutes
{
    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     */
    function __invoke(Request $request, Response $response, array $args)
    {
        parent::__invoke($request, $response, $args);
        $this->logoutAction();
        $uri = $request->getUri()->withPath("/");
        return $response->withRedirect((string)$uri);
    }

    public function logoutAction()
    {
        $controller = new Controller\PostController($this->container);
        $recentPosts = $controller->getRecentPosts();

        $displayedPosts = $controller->getPosts();

        $_SESSION['user'] = null;

//        $this->renderView($recentPosts, $displayedPosts);
    }

    /**
     * @param $recentPosts
     * @param $post
     * @return mixed
     */
    private function renderView($recentPosts, $displayedPost)
    {
        return $this->container->view->render(
            $this->response,
            'displayPosts.twig',
            [
                'recentPosts' => $recentPosts,
                'displayedPost' => $displayedPost
            ]
        );
    }
}
