<?php

namespace M151\LibraryOK\Model;


use M151\LibraryOK\Repository\PostRepository;

class Post extends ArrayObject
{
    public $post_id;

    public $title;

    public $subTitle;

    public $content;

    public $titleImage;

    public $username;

    public $postTypeName;

    public $tstmp;

    public $repository;

    /**
     * Post constructor.
     * @param null $container
     * @param null $post
     */
    public function __construct($container = null, $post = null)
    {
        parent::__construct($container);
        $this->exchangeArray($post);
        if($container)
            $this->repository = new PostRepository($this->container);
    }

    public function fillPost($post) {
        $this->title = $post['title'];
        $this->subTitle = $post['subTitle'];
        $this->content = $post['content'];
        $this->titleImage = $post['titleImage'];
        $this->username = $post['username'];
        $this->postTypeName = $post['postTypeName'];
    }

    public function savePost() {
        $this->repository->savePost($this);
    }

    public function updatePost() {
        $this->repository->updatePost($this);
    }

    public function removePost() {
        $this->repository->removePost($_SESSION['post_id']);
    }

}