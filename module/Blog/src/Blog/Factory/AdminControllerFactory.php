<?php
namespace Blog\Factory;

use Blog\Controller\AdminController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AdminControllerFactory implements FactoryInterface{

    public function createService(ServiceLocatorInterface $serviceLocator){

        $realServiceLocator = $serviceLocator->getServiceLocator();
        $postService        = $realServiceLocator->get('Blog\Service\PostServiceInterface');

        return new AdminController($postService);
}
}