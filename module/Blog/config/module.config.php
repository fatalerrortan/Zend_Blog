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
//            'Blog\Controller\Post' => 'Blog\Controller\PostController',
//        ),
        'factories' => array(
            'Blog\Controller\Index' => 'Blog\Factory\IndexControllerFactory',
            'Blog\Controller\Post' => 'Blog\Factory\PostControllerFactory',
            'Blog\Controller\Admin' => 'Blog\Factory\AdminControllerFactory',
            'Blog\Controller\Posts' => 'Blog\Factory\PostsControllerFactory',
        )
    ),

    'service_manager' => array(
        'invokables' => array(
            'Blog\Service\PostServiceInterface' => 'Blog\Service\PostService'
        ),
        'factories' => array(
            'Zend\Session\SessionManager' => 'Zend\Session\SessionManagerFactory',
            'Zend\Session\Config\ConfigInterface' => 'Zend\Session\Service\SessionConfigFactory',
        )
    ),
// This lines opens the configuration for the RouteManager
    'router' => array(
        // Open configuration for all possible routes
        'routes' => array(
            // Define a new route called "blog"
            'blog' => array(
                'type'    => 'segment',
                // Configure the route itself
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
    //Router for PostController
//        'routes' => array(
//            // Define a new route called "blog"
//            'post' => array(
//                'type'    => 'segment',
//                // Configure the route itself
//                'options' => array(
//                    'route'    => '/post[/:action][/:id]',
//                    'constraints' => array(
//                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                        'id'     => '[0-9]+',
//                    ),
//                    'defaults' => array(
//                        'controller' => 'Blog\Controller\Post',
//                        'action'     => 'index',
//                    ),
//                ),
//            ),
//        ),
        //Router for AdminController
        'routes' => array(
            // Define a new route called "blog"
            'admin' => array(
                'type'    => 'segment',
                // Configure the route itself
                'options' => array(
                    'route'    => '/admin[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Blog\Controller\Admin',
                        'action'     => 'login',
                    ),
                ),
            ),
        ),

        'routes' => array(
            // Define a new route called "blog"
            'posts' => array(
                'type'    => 'segment',
                // Configure the route itself
                'options' => array(
                    'route'    => '/posts[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Blog\Controller\Posts',
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
        // The TemplateMapResolver allows you to directly map template names
        // to specific templates.
//        'template_map' => array(
//           'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
//        ),
    ),

    'view_helpers' => array(
        'invokables'=> array(
            'load_category' => 'Blog\View\Helper\LoadCategory',
            'load_homepageWord' => 'Blog\View\Helper\LoadHomepageWord',
        )
    ),
//    'db' => array(
//        'driver'         => 'Pdo',
//        'username'       => '',  //edit this
//        'password'       => '',  //edit this
//        'dsn'            => 'mysql:dbname=;host=',
//        'driver_options' => array(
//            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
//        )
//    ),
);