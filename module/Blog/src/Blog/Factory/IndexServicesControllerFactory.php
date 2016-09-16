<?php
namespace Blog\Factory;

use Blog\Controller\IndexController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class IndexServicesControllerFactory implements FactoryInterface{

    public function createService(ServiceLocatorInterface $serviceLocator){

        $realServiceLocator = $serviceLocator->getServiceLocator();
        $postService        = $realServiceLocator->get('Blog\Service\PostServiceInterface');
        $emailService       = $realServiceLocator->get('Blog\Service\EmailServiceInterface');

        return new IndexController($postService, $emailService);
    }
}