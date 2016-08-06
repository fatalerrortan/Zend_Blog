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

//        $pageIndex = $this->params()->fromQuery('page');
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
            'allposts' => $this->formatTargetPosts($this->postService->findAllPosts('ur'))));
        $allPostsView->setTemplate('template/content/allPostsView.phtml');
        $view->addChild($allPostsView, '_allPostsView');

//       echo $this->postService->insertTest();
        return $view;
    }

    public function ajaxAction(){

//        echo "it is working for ajax";
        $pageIndex = $this->params()->fromQuery('page');
        $content =  $this->formatTargetPosts($this->postService->findAllPosts($pageIndex));
        $response = $this->getResponse();
        $response->setContent($content);
        return $response;
    }

    public function formatTargetPosts($array){

        $contentInUl = '';
        foreach ($array as $item){
            if(empty($item['post_id'])){
//                to Do for no Content
            }
            $contentInUl .= "<li>
                            <i class=\"fa fa-plug\" aria-hidden=\"true\"></i> <a><h4>".$item['post_title']."</h4></a><br />
                            <p class='contentUnderTitle'>
                                <span class='glyphicon glyphicon-time'></span> 
                                <b>Posted on</b> ".$item['post_create_time']." <b>
                                   &nbsp;<i class=\"fa fa-tags\" aria-hidden=\"true\"></i>Category:</b> 
                                <a>".$item['post_category']."</a> 
                                    &nbsp;<i class=\"fa fa-user\" aria-hidden=\"true\"></i>
                                <b>Posted by</b> ".$item['user_name']."</p>
                        </li><br />";
        }

        return $contentInUl;
    }
}