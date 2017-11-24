<?php

namespace M151\LibraryOK\Controller;

use M151\LibraryOK\Model\Post;
use M151\LibraryOK\Model\PostCollection;

/**
 * Class IndexController
 * @package M151\LibraryOK\Controller
 */
class PostController extends AbstractController
{
    /**
     * IndexController constructor.
     */
    public function __construct($container)
    {
        parent::__construct($container);
    }

    public function getRecentPosts()
    {
        return parent::getRecentPosts();
    }

    public function getPost() {
        return parent::getPost();
    }

    public function getPostTypes() {
        $controller = new PostCollection($this->container, "none");
        return $controller->getPostTypes();
    }

    public function savePost($post) {
        $post = new Post($this->container, $post);
        $post->username = $_SESSION['user']['username'];
        $post->savePost();
    }

    public function updatePost($post) {
        if($post['title'] != "" || !isset($post['title'])) {
            $post = new Post($this->container, $post);
            $post->username = $_SESSION['user']['username'];
            $post->updatePost();
            return true;
        }
        return false;
    }

    public function getLastPost() {
        $controller = new PostCollection($this->container, "last");
        return $controller->posts[0];
    }

    public function removePost() {
        $post = new Post($this->container);
        $post->removePost();
    }

    public function getPosts($type = null)
    {
        return parent::getPosts($type);
    }
}
