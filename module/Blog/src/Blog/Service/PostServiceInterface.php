<?php

namespace Blog\Service;

use Blog\Model\PostInterface;

interface PostServiceInterface{

    //@return array|PostInterface[]
    public function findAllPosts();
    //@return PostInterface
    public function findPost($id);
}