<?php

/**
 * Created by PhpStorm.
 * User: FatalError
 * Date: 5/19/2016
 * Time: 1:31 AM
 */
namespace Blog\Controller;

use Blog\Service\PostServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class PostController extends AbstractActionController{

    protected $postService;

    public function __construct(PostServiceInterface $postService){

        $this->postService = $postService;
    }

    public function indexAction(){

        $view = new ViewModel();
        $layout = $this->layout();
        $headerView = new ViewModel(array('message' => 'header'));
        $headerView->setTemplate('template/header/header.phtml');
        $layout->addChild($headerView, '_headerView');

        $sidebarView = new ViewModel(array('message' => 'sidebar'));
        $sidebarView->setTemplate('template/sidebar/sidebar_post.phtml');
        $view->addChild($sidebarView, '_sidebarView');

       echo $this->postService->insertTest();


        return $view;
    }

    public function testAction(){


    }
}