<?php


namespace M151\LibraryOK\Controller;

use M151\LibraryOK\Model\Product;
use M151\LibraryOK\Model\PostCollection;

/**
 * Class IndexController
 * @package M151\LibraryOK\Controller
 */
class IndexController extends AbstractController
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

    public function getPosts($type = null) {
        return parent::getPosts($type);
    }
}
