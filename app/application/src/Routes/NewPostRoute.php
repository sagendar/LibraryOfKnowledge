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
class NewPostRoute extends AbstractRoutes
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
        $postTypes = $controller->getPostTypes();

        $user = [];

        $usercontroller = new Controller\UserController($this->container);

        $user = $usercontroller->isLoggedIn();
        if(!$user['loggedIn']) {
            $this->renderView($recentPosts, $postTypes, $user, "profil");
        }
        $this->renderView($recentPosts, $postTypes, $user, "posts");
    }

    private function renderView($recentPosts, $postTypes, $user, $current)
    {
        return $this->container->view->render(
            $this->response,
            'newPost.twig',
            [
                'recentPosts' => $recentPosts,
                'postTypes' => $postTypes,
                'current' => $current,
                'user' => $user
            ]
        );
    }
}
