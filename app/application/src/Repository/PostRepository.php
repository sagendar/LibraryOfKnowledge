<?php
namespace M151\LibraryOK\Repository;
use M151\LibraryOK\Model\Post;
use Psr\Container\ContainerInterface;
/**
 * Class PostRepository
 * @package M151\LibraryOK\Repository
 */
class PostRepository
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
    /**
     * @return array
     */
    public function fetchAllPosts() {
        $sql = $this->db->prepare("call libraryofknowledge.fetchAllPosts();");
        $sql->execute();
        return $sql->fetchAll();
    }
    /**
     * @return array
     */
    public function fetchAllDocumentations() {
        $sql = $this->db->prepare("call libraryofknowledge.fetchAllDocumentations();");
        $sql->execute();
        return $sql->fetchAll();
    }
    /**
     * @return array
     */
    public function fetchAllQuestions() {
        $sql = $this->db->prepare("call libraryofknowledge.fetchAllQuestions();");
        $sql->execute();
        return $sql->fetchAll();
    }
    /**
     * @param $id
     * @return array
     */
    public function fetchSinglePost($id) {
        $sql = $this->db->prepare("SELECT post_id, title, subTitle, content, titleImage, username, postTypeName, p.tstmp
                                   FROM posts p
                                   JOIN users u ON user_id=user_fk 
                                   JOIN posttype pt ON postType_id=postType_fk
                                   WHERE post_id=$id");
        $sql->execute();
        return $sql->fetchAll();
    }
    public function fetchRecentPosts() {
        $sql = $this->db->prepare("call libraryofknowledge.fetchRecentPosts();");
        $sql->execute();
        return $sql->fetchAll();
    }
    public function fetchColPosts($offset, $postsPerPage) {
        $sql = $this->db->prepare("SELECT post_id, title, subTitle, content, titleImage, username, postTypeName, p.tstmp AS tstmp
                FROM posts p
                JOIN users u ON user_id=user_fk 
                JOIN posttype pt ON postType_id=postType_fk 
                LIMIT $offset, $postsPerPage;");
        $sql->execute();
        return $sql->fetchAll();
    }
    public function fetchColPostsSpecific($offset, $postsPerPage, $type) {
        $sql = $this->db->prepare("SELECT post_id, title, subTitle, content, titleImage, username, postTypeName, p.tstmp AS tstmp
                FROM posts p
                JOIN users u ON user_id=user_fk 
                JOIN posttype pt ON postType_id=postType_fk 
                WHERE postTypeName='$type' 
                LIMIT $offset, $postsPerPage;");
        $sql->execute();
        return $sql->fetchAll();
    }
    public function fetchPostTypes() {
        $sql = $this->db->prepare("call libraryofknowledge.fetchPostTypes();");
        $sql->execute();
        return $sql->fetchAll();
    }
    /**
     * @param $post Post
     */
    public function savePost($post) {
        $sql = $this->db->prepare("INSERT INTO posts (title, subTitle, content, titleImage, user_fk, postType_fk) 
                                             VALUES ('$post->title', '$post->subTitle', '$post->content', '$post->titleImage', 
                                             (SELECT user_id FROM users WHERE username='$post->username'), 
                                             (SELECT postType_id FROM posttype WHERE postTypeName='$post->postTypeName'));");
        $sql->execute();
    }
    /**
     * @param $post Post
     */
    public function updatePost($post) {
        $sql = $this->db->prepare("UPDATE posts
                                             SET title='$post->title', subTitle='$post->subTitle', content='$post->content', titleImage='$post->titleImage', postType_fk=(SELECT postType_id FROM posttype WHERE postTypeName='$post->postTypeName')
                                             WHERE post_id=". $_SESSION['post_id'] . ";");
        $sql->execute();
    }
    public function removePost($post_id) {
        $sql = $this->db->prepare("DELETE FROM posts
                                             WHERE post_id=$post_id LIMIT 1;");
        $sql->execute();
    }
    public function fetchLastPost() {
        $sql = $this->db->prepare("call libraryofknowledge.fetchLastPost();");
        $sql->execute();
        return $sql->fetchAll();
    }
}