<?php

namespace M151\LibraryOK\Controller;

use M151\LibraryOK\Model\Coin;
use M151\LibraryOK\Model\Post;
use Psr\Container\ContainerInterface;
use M151\LibraryOK\Model;

/**
 * Class AbstractController
 * @package M151\LibraryOK\Controller
 */
abstract class AbstractController
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * AbstractController constructor.
     */
    public function __construct($container)
    {
        $this->container = $container;
    }

    protected function getRecentPosts() {
        $posts = new Model\PostCollection($this->container, "recent");
        $response = [];

//        print_r($posts->posts);

        /**
         * @var $post Post
         */
        foreach($posts->posts as $post) {
            array_push($response, [
                'title' => $post['title'],
                'id' => $post['post_id']
            ]);
        }

        return $response;
    }

    protected function getPosts($type = null) {
        if(!is_numeric($_SESSION['col'])) {
            return [
                'status' => 'Error',
                'message' => 'the value column needs to be an integer'
            ];
        }
        $posts = new Model\PostCollection($this->container, "none");

        $postsPerPage = 2;

        $offset = ($_SESSION['col'] - 1) * $postsPerPage;
        $displayedPosts = $posts->fetchColPosts($offset, $postsPerPage, $type);

        return $displayedPosts;
    }

    protected function getPost() {
        if(!is_numeric($_SESSION['post_id'])) {
            return [
                'status' => 'Error',
                'message' => 'Post has to be selected'
            ];
        }
        $post = new Model\PostCollection($this->container, $_SESSION['post_id']);

        return $post;
    }

}