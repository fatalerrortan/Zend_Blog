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

        $pageIndex = $this->params()->fromQuery('page');
//      layout
        $layout = $this->layout();
        $headerView = new ViewModel();
        $headerView->setTemplate('template/header/header.phtml');
        $layout->addChild($headerView, '_headerView');
        $view = new ViewModel();
//        sidebar
        $sidebarView = new ViewModel(array('message' => 'sidebar'));
        $sidebarView->setTemplate('template/sidebar/sidebar_post.phtml');
        $view->addChild($sidebarView, '_sidebarView');
//        all posts template
        $allPostsView = new ViewModel(array(
            'allposts' => $this->postService,
            'pageindex' => $pageIndex));
        $allPostsView->setTemplate('template/content/allPostsView.phtml');
        $view->addChild($allPostsView, '_allPostsView');

//       echo $this->postService->insertTest();
        return $view;
    }
}