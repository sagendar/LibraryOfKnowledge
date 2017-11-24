<?php
namespace M151\LibraryOK\Repository;
use M151\LibraryOK\Model\Post;
use M151\LibraryOK\Model\User;
use Psr\Container\ContainerInterface;
/**
 * Class PostRepository
 * @package M151\LibraryOK\Repository
 */
class UserRepository
{
    /**
     * @var ContainerInterface
     */
    protected $container;
    /**
     * @var \PDO
     */
    private $db;
    /**
     * PostRepository constructor.
     * @param ContainerInterface $container
     */
    function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->db = $this->container->db;
    }
    public function fetchAllUsers() {
        $sql = $this->db->prepare("call libraryofknowledge.fetchAllUsers();");
        $sql->execute();
        return $sql->fetchAll();
    }
    public function fetchUser($username) {
        $sql = $this->db->prepare("SELECT user_id, firstname, surname, username, password, permission, country, tstmp 
                                             FROM users
                                             JOIN permissions ON permission_id=permission_fk
                                             JOIN country ON country_id=country_fk
                                             WHERE username='$username'");
        $sql->execute();
        return $sql->fetchAll();
    }
    public function login($username) {
        $sql = $this->db->prepare("SELECT password, permission
                                   FROM users
                                   JOIN permissions ON permission_id=permission_fk
                                   WHERE username='$username'");
        $sql->execute();
        return $sql->fetchAll();
    }
    /**
     * @param $user User
     */
    public function createUser($user) {
        if($user->username == "" || !isset($user->username)) {
            return;
        }
        $sql = $this->db->prepare("INSERT IvagNTO users (firstname, surname, username, password, permission_fk, country_fk)
         VALUES ('$user->firstname', '$user->surname', '$user->username', '$user->password', 2, 1)");
        $sql->execute();
    }
}