<?php

namespace M151\LibraryOK\Controller;

use M151\LibraryOK\Model\Post;
use M151\LibraryOK\Model\PostCollection;
use M151\LibraryOK\Model\User;
use M151\LibraryOK\Model\UserCollection;

/**
 * Class IndexController
 * @package M151\LibraryOK\Controller
 */
class UserController extends AbstractController
{
    /**
     * UserController constructor.
     * @param $container
     */
    public function __construct($container)
    {
        parent::__construct($container);
    }

    public function getRecentPosts()
    {
        return parent::getRecentPosts();
    }

    public function login($post) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $user = new UserCollection($this->container, "none");
        $pw = $user->login($username);

        if($pw[0]['password'] === sha1($password)) {
            $users = [
                'username' => $username,
                'loggedIn' => true,
                'permission' => $pw[0]['permission']
            ];
        } else {
            return false;
        }

        $_SESSION['user'] = $users;

        return $users;
    }

    public function isLoggedIn() {
        return isset($_SESSION['user']) ? $_SESSION['user'] : [];
    }

    public function getUser() {
        $test = new UserCollection($this->container, "none");
        $user = $test->fetchSingleUser($_SESSION['name']);
        return $user;
    }

    public function createUser($post) {
        $user = new User($this->container, "none");
        $user->fillUser($post);
        $user->insertDB();

        $userInfo = [
            'username' => $user->username,
            'loggedIn' => true,
            'permission' => "Normal User"
        ];

        $_SESSION['user'] = $userInfo;
    }
}
