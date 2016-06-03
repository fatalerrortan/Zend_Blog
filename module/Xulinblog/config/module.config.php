<?php
/**
 * Created by PhpStorm.
 * User: FatalError
 * Date: 5/19/2016
 * Time: 1:19 AM
 */
return array(
    'controllers' => array(
        'invokables' => array(
            'Xulinblog\Controller\Index' => 'Xulinblog\Controller\IndexController',
        ),
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