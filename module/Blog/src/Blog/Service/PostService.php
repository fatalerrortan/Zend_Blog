<?php
namespace Blog\Service;

use Blog\Model\Post;

class PostService implements PostServiceInterface{
    /**
     * @var \Blog\Mapper\PostMapperInterface
     */
    public $postMapper;

    /**
     * @param PostMapperInterface $postMapper
     */
    public function __construct(){

        $host_name  = "db629553808.db.1and1.com";
        $database   = "db629553808";
        $user_name  = "dbo629553808";
        $password   = "txl881706";
        $connect = mysqli_connect($host_name, $user_name, $password, $database);
        if(!mysqli_connect_errno()) {

            $this->postMapper = 'It works';
        }
    }

    public function findAllPosts(){
        // TODO: Implement findAllPosts() method.

    }

    public function findPost($id){
        // TODO: Implement findPost() method.
    }
}