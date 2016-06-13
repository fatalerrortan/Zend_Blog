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
//            'Blog\Controller\Index' => 'Blog\Controller\IndexController',
//        ),
        'factories' => array(
            'Blog\Controller\Index' => 'Blog\Factory\IndexControllerFactory'
        )
    ),

    'service_manager' => array(
//        'invokables' => array(
//            'Blog\Service\PostServiceInterface' => 'Blog\Service\PostService'
//        ),
        'factories' => array(
            'Blog\Service\PostServiceInterface' => 'Blog\Factory\PostServiceFactory'
        )
    ),

    'router' => array(
        'routes' => array(
            'blog' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/blog[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Blog\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'blog' => __DIR__ . '/../view',
        ),
//        set Layout
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
        ),
    ),

    'db' => array(
        'driver'         => 'Pdo',
        'username'       => 'dbo629553808',  //edit this
        'password'       => 'txl881706',  //edit this
        'dsn'            => 'mysql:dbname=db629553808;host=db629553808.db.1and1.com',
        'driver_options' => array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        )
    ),
);