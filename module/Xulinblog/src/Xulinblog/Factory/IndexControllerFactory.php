<?php
/**
 * Created by PhpStorm.
 * User: FatalError
 * Date: 6/5/2016
 * Time: 1:40 AM
 */
namespace Xulinblog\Factory;

use Xulinblog\Controller\IndexController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class IndexControllerFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        $postService        = $realServiceLocator->get('Xulinblog\Service\PostServiceInterface');

        return new IndexController($postService);
    }
}