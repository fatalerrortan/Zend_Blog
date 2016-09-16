<?php
namespace Blog\Factory;

use Blog\Controller\AdminController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AdminServicesControllerFactory implements FactoryInterface{

    public function createService(ServiceLocatorInterface $serviceLocator){

        $realServiceLocator = $serviceLocator->getServiceLocator();
        $postService        = $realServiceLocator->get('Blog\Service\PostServiceInterface');
        $emailService       = $realServiceLocator->get('Blog\Service\EmailServiceInterface');

        return new AdminController($postService, $emailService);
    }
}