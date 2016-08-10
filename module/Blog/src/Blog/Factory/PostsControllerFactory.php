<?php

namespace Blog\Factory;

use Blog\Controller\PostsController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PostsControllerFactory implements FactoryInterface{

    public function createService(ServiceLocatorInterface $serviceLocator){

        $realServiceLocator = $serviceLocator->getServiceLocator();
        $postService        = $realServiceLocator->get('Blog\Service\PostServiceInterface');

        return new PostsController($postService);
    }
}