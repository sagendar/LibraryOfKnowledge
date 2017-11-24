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
class RemovePostRoute extends AbstractRoutes
{
    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     */
    function __invoke(Request $request, Response $response, array $args)
    {
        parent::__invoke($request, $response, $args);
        $this->removePostAction();
        $uri = $request->getUri()->withPath("/");
        return $response->withRedirect((string)$uri);
    }

    public function removePostAction()
    {
        $controller = new Controller\PostController($this->container);
        $recentPosts = $controller->getRecentPosts();
        $post = $controller->getPost();
        $displayedPosts = $controller->getPosts("Documentation");

        $user = [];

        $usercontroller = new Controller\UserController($this->container);

        $user = $usercontroller->isLoggedIn();

        if($user['username'] == $post->posts[0]['username'] || $user['permission'] == "Administrator") {
            $controller->removePost();
        }

//        $this->renderView($recentPosts, $displayedPosts, $user);
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
