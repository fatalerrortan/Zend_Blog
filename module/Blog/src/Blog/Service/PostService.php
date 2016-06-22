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