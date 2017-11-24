<?php

namespace M151\LibraryOK\Model;

use M151\LibraryOK\Repository\PostRepository;

class PostCollection extends ArrayObject
{
    /**
     * @var array
     */
    public $posts = [];

    /**
     * @var PostRepository
     */
    private $repository;

    function __construct($container, $params)
    {
        parent::__construct($container);
        $this->repository = new PostRepository($this->container);
        $params = $this->prepareParams($params);
        if($params['posts'] == '') {
            return;
        }
        if (!is_array($params)) {
            throw new \Exception('Array expectet, ' .
                gettype($params) .
                ' passed.');
        }
        $this->exchangeArray($params);
        $this->exchangeObjects();

    }

    private function prepareParams($params) {
        switch ($params) {
            case "none":
                return ['posts' => ''];
            case "all":
                return ['posts' => $this->fetchAllPosts()];
            case "docs":
                return ['posts' => $this->fetchAllDocumentations()];
            case "quest":
                return ['posts' => $this->fetchAllQuestions()];
            case "recent":
                return ['posts' => $this->fetchRecentPosts()];
            case "last":
                return ['posts' => $this->fetchLastPost()];
            default:
                return ['posts' => $this->fetchSinglePost($params)];
        }
    }

    public function fetchLastPost() {
        return $this->repository->fetchLastPost();
    }

    public function fetchColPosts($offset, $postsPerPage, $type = null) {
        if($type)
            return $this->repository->fetchColPostsSpecific($offset, $postsPerPage, $type);

        return $this->repository->fetchColPosts($offset, $postsPerPage);
    }

    private function fetchAllPosts() {
        return $this->repository->fetchAllPosts();
    }

    private function fetchAllDocumentations() {
        return $this->repository->fetchAllDocumentations();
    }

    private function fetchAllQuestions() {
        return $this->repository->fetchAllQuestions();
    }

    private function fetchSinglePost($id) {
        return $this->repository->fetchSinglePost($id);
    }

    private function fetchRecentPosts() {
        return $this->repository->fetchRecentPosts();
    }

    public function exchangeObjects()
    {
        $productsObjects = [];

        foreach ($this->posts as $post){
            $productsObjects[] = new Post(null, $post);
        }
        $this->products = $productsObjects;
    }

    public function getPostTypes() {
        return $this->repository->fetchPostTypes();
    }

}