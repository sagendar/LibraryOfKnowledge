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
class AddPostRoute extends AbstractRoutes
{
    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     */
    function __invoke(Request $request, Response $response, array $args)
    {
        parent::__invoke($request, $response, $args);
        $this->newPostAction();
    }

    public function newPostAction()
    {
        $controller = new Controller\PostController($this->container);
        $recentPosts = $controller->getRecentPosts();
        $controller->savePost($_POST);
        $post = $controller->getLastPost();

        $usercontroller = new Controller\UserController($this->container);

        $user = $usercontroller->isLoggedIn();

        $this->renderView($recentPosts, $post, $user);
    }

    /**
     * @param $recentPosts
     * @param $post
     * @return mixed
     */
    private function renderView($recentPosts, $post, $user)
    {
        return $this->container->view->render(
            $this->response,
            'singlePost.twig',
            [
                'recentPosts' => $recentPosts,
                'displayedPost' => $post,
                'user' => $user
            ]
        );
    }
}
