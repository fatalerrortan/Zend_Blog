<?php

namespace Blog\Factory;

use Blog\Controller\PostController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PostControllerFactory implements FactoryInterface{

    public function createService(ServiceLocatorInterface $serviceLocator){

        $realServiceLocator = $serviceLocator->getServiceLocator();
        $postService        = $realServiceLocator->get('Blog\Service\PostServiceInterface');

        return new PostController($postService);
    }
}