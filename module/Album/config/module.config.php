<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 25.12.15
 * Time: 03:29
 */
return array(
    'controllers' => array(
        'invokables' => array(
            'Album\Controller\Album' => 'Album\Controller\AlbumController',
        ),
    ),

    'router' => array(
        'routes' => array(
            'album' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/album[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Album\Controller\Album',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),


    'view_manager' => array(
        'template_path_stack' => array(
            'album' => __DIR__ . '/../view',
        ),
    ),
);

//The config information is passed to the relevant components by the ServiceManager. We need two initial sections: controllers and
//view_manager. The controllers section provides a list of all the controllers provided by the module. We will need one controller,
//AlbumController, which we’ll reference as Album\Controller\Album. The controller key must be unique across all modules, so we
//prefix it with our module name.
//
//Within the view_manager section, we add our view directory to the TemplatePathStack configuration. This will allow it to find the
//view scripts for the Album module that are stored in our view/ directory.