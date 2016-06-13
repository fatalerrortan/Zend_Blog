<?php
namespace Blog\Service;

use Blog\Model\Post;
use Blog\Mapper\PostMapperInterface;

class PostService implements PostServiceInterface{
    /**
     * @var \Blog\Mapper\PostMapperInterface
     */
    protected $postMapper;

    /**
     * @param PostMapperInterface $postMapper
     */
    public function __construct(PostMapperInterface $postMapper)
    {
        $this->postMapper = $postMapper;
    }
    public function findAllPosts(){
        // TODO: Implement findAllPosts() method.
        return $this->postMapper->findAll();
    }

    public function findPost($id){
        // TODO: Implement findPost() method.
        return $this->postMapper->find($id);
    }
}