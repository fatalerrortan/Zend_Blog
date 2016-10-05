<?php
/**
 * Created by PhpStorm.
 * User: FatalError
 * Date: 5/19/2016
 * Time: 1:06 AM
 */
namespace Blog;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
//first we need to let the ModuleManager know that our module has configuration that it needs to load. "public function getConfig()"
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Mvc\MvcEvent;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface{

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig(){

        //get config data from module.config.php
        return include __DIR__ . '/config/module.config.php';
    }
//    Register for custom Helper function
//    public function getViewHelperConfig(){
//
//        return array(
//            'factories' => array(
//                'test_helper' => function($sm) {
//                    $helper = new View\Helper\Testhelper ;
//                    return $helper;
//                }
//            )
//        );
//    }

    public function onBootstrap(MvcEvent $event){

        $eventManager       = $event->getApplication()->getEventManager();
        $sharedEventManager = $eventManager->getSharedManager();

        $sharedEventManager->attach('Blog\Service\EmailService', 'sendTweet', function($e) {

            print_r($e->getParams('content'));
        }, 100);

        $sharedEventManager->attach('Blog\Service\EmailService', 'postEmail', function($e) {

            print_r($e->getParams('content'));
        }, 100);
    }
}