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
class MakeChangesRoute extends AbstractRoutes
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
        $uri = $request->getUri()->withPath("/");
        return $response->withRedirect((string)$uri);
    }

    public function indexAction()
    {
        $controller = new Controller\PostController($this->container);
        $recentPosts = $controller->getRecentPosts();
        $controller->updatePost($_POST);
        $post = $controller->getPost();

        $user = [];

        $usercontroller = new Controller\UserController($this->container);

        $user = $usercontroller->isLoggedIn();

//        $this->renderView($recentPosts, $post->posts[0], $user);
    }

    private function renderView($recentPosts, $displayedPost, $user)
    {
        return $this->container->view->render(
            $this->response,
            'singlePost.twig',
            [
                'recentPosts' => $recentPosts,
                'displayedPost' => $displayedPost,
                'user' => $user
            ]
        );
    }
}
