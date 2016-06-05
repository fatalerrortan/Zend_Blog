<?php
/**
 * Created by PhpStorm.
 * User: FatalError
 * Date: 5/19/2016
 * Time: 1:19 AM
 */
return array(
    'controllers' => array(
//        An invokable is a class that can be constructed without any arguments
//        'invokables' => array(
//            'Xulinblog\Controller\Index' => 'Xulinblog\Controller\IndexController',
//        ),
            'factories' => array(
                'Xulinblog\Controller\Index' => 'Xulinblog\Factory\IndexControllerFactory'
            )
    ),

    'service_manager' => array(
        'invokables' => array(
            'Xulinblog\Service\PostServiceInterface' => 'Xulinblog\Service\PostService'
        )
    ),

    'router' => array(
        'routes' => array(
            'xulinblog' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/xulinblog[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Xulinblog\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'xulinblog' => __DIR__ . '/../view',
        ),
//        set Layout
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
        ),
    ),
);