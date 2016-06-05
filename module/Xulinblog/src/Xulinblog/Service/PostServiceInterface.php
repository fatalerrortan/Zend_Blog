<?php
/**
 * Created by PhpStorm.
 * User: FatalError
 * Date: 6/4/2016
 * Time: 11:49 PM
 */
namespace Xulinblog\Service;
//We make the assumption that the return value all in all are of type Blog\Model\PostInterface
use Xulinblog\Model\PostInterface;

interface PostServiceInterface{

    public function findAllPosts();

    public function findPost($id);
}