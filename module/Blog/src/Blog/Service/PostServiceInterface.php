<?php

namespace Blog\Service;

use Blog\Model\PostInterface;

interface PostServiceInterface{

    /**
     * Should return a set of all blog posts that we can iterate over. Single entries of the array are supposed to be
     * implementing \Blog\Model\PostInterface
     *
     * @return array|PostInterface[]
     */
    public function findAllPosts($pageIndex, $category, $pattern);

    /**
     * Should return a single blog post
     *
     * @param  int $id Identifier of the Post that should be returned
     * @return PostInterface
     */
    public function findPost($id);
    public function dbUpdate($id, $content, $category, $keyword, $title);
    public function dbSave($content, $title, $category, $tags);
    public function dbPush($post_id);
    public function dbDelete($post_id);
    public function userMapping($username, $password);
    public function userInsert($user_email);
}