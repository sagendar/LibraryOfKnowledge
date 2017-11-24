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
class EditPostRoute extends AbstractRoutes
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
        return $this->loginAction();
    }

    public function indexAction()
    {
        $controller = new Controller\PostController($this->container);
        $recentPosts = $controller->getRecentPosts();
        $post = $controller->getPost();
        $postTypes = $controller->getPostTypes();
        $displayedPosts = $controller->getPosts();

        $user = [];

        $usercontroller = new Controller\UserController($this->container);

        $user = $usercontroller->isLoggedIn();

        if($user['username'] == $post->posts[0]['username'] || $user['permission'] == "Administrator") {
            $controller->updatePost($_POST);
            $this->renderView($recentPosts, $post->posts[0], $postTypes, $user, "editPost");
        } else {
            $uri = $this->request->getUri()->withPath("/");
            return $this->response->withRedirect((string)$uri);
        }


//        $this->renderView($recentPosts, $post->posts[0], $postTypes, $user, "displayPosts", $displayedPosts);
    }

    private function renderView($recentPosts, $post, $postTypes, $user, $page, $displayedPosts = null)
    {
        return $this->container->view->render(
            $this->response,
            $page . '.twig',
            [
                'recentPosts' => $recentPosts,
                'post' => $post,
                'postTypes' => $postTypes,
                'user' => $user,
                'displayedPosts' => $displayedPosts
            ]
        );
    }
}
