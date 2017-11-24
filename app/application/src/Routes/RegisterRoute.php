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
class RegisterRoute extends AbstractRoutes
{
    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     */
    function __invoke(Request $request, Response $response, array $args)
    {
        parent::__invoke($request, $response, $args);
        return $this->newPostAction();
    }

    public function newPostAction()
    {
        $controller = new Controller\PostController($this->container);
        $recentPosts = $controller->getRecentPosts();
        $displayedPosts = $controller->getPosts();

        $user = [];
        if(!isset($_POST['username'])) {
            return $this->renderView($recentPosts, "register");
        }
        $usercontroller = new Controller\UserController($this->container);
        $usercontroller->createUser($_POST);
        $_POST = null;

        $userinfo = $_SESSION['user'];

        $uri = $this->request->getUri()->withPath("/");
        return $this->response->withRedirect((string)$uri);


//        $this->renderView($recentPosts, "displayPosts", $userinfo, $displayedPosts);
    }

    /**
     * @param $recentPosts
     * @return mixed
     */
    private function renderView($recentPosts, $page, $user = null, $displayedPosts = null)
    {
        return $this->container->view->render(
            $this->response,
            $page . '.twig',
            [
                'recentPosts' => $recentPosts,
                'current' => 'posts',
                'user' => $user,
                'displayedPosts' => $displayedPosts
            ]
        );
    }
}
