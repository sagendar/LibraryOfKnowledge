<?php

namespace M151\LibraryOK\Model;


use M151\LibraryOK\Repository\PostRepository;
use M151\LibraryOK\Repository\UserRepository;

class User extends ArrayObject
{
    public $user_id;

    public $firstname;

    public $surname;

    public $username;

    public $password;

    public $permission;

    public $country;

    public $tstmp;

    public $repository;

    public function __construct($container = null, $user = null)
    {
        parent::__construct($container);
        if($container)
            $this->repository = new UserRepository($this->container);
    }

    public function fillUser($user) {
        $this->user_id = $user['user_id'];
        $this->firstname = $user['firstname'];
        $this->surname = $user['surname'];
        $this->username = $user['username'];
        $this->password = sha1($user['password']);
        $this->permission = $user['permission'];
        $this->country = $user['country'];
    }

    public function insertDB() {
        $this->repository->createUser($this);
    }

}