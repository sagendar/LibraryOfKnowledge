<?php

namespace M151\LibraryOK\Model;

use M151\LibraryOK\Repository\PostRepository;
use M151\LibraryOK\Repository\UserRepository;

class UserCollection extends ArrayObject
{
    /**
     * @var array
     */
    public $users = [];

    /**
     * @var PostRepository
     */
    private $repository;

    function __construct($container, $params)
    {
        parent::__construct($container);
        $this->repository = new UserRepository($this->container);
        $params = $this->prepareParams($params);
        if($params['users'] == '') {
            return;
        }
        print_r($params['users']);
        if (!is_array($params)) {
            throw new \Exception('Array expectet, ' .
                gettype($params) .
                ' passed.');
        }
        $this->exchangeArray($params);
        $this->exchangeObjects();

    }

    public function login($username) {
        return $this->repository->login($username);
    }

    private function prepareParams($params) {
        switch ($params) {
            case "none":
                return ['users' => ''];
            case "all":
                return ['users' => $this->fetchAllUsers()];
            default:
                return ['users' => $this->fetchSingleUser($params)];
        }
    }

    private function fetchAllUsers() {
        return $this->repository->fetchAllUsers();
    }

    public function fetchSingleUser($username) {
        $test = $this->repository->fetchUser($username);
        return $test;
    }

    public function exchangeObjects()
    {
        $usersObjects = [];
        foreach ($this->users as $user){
            $usersObjects[] = new User(null, $user);
        }
        $this->users = $usersObjects;
    }
}