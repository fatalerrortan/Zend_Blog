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

        $category = $this->params()->fromQuery('category');
//      layout
//        $layout = $this->layout();
//        $headerView = new ViewModel();
//        $headerView->setTemplate('template/header/header.phtml');
//        $layout->addChild($headerView, '_headerView');
        $view = new ViewModel();
//        sidebar
        $sidebarView = new ViewModel(array(
            'newposts' => $this->formatTargetPosts($this->postService->findAllPosts(0), false)
        ));
        $sidebarView->setTemplate('template/sidebar/sidebar_post.phtml');
        $view->addChild($sidebarView, '_sidebarView');
//        all posts template
        $allPostsView = new ViewModel(array(
            'allposts' => $this->formatTargetPosts($this->postService->findAllPosts(0, $category), true)));
        $allPostsView->setTemplate('template/content/allPostsView.phtml');
        $view->addChild($allPostsView, '_allPostsView');
//       echo $this->postService->insertTest();
        return $view;
    }

    public function articleAction(){

        $id = $this->params()->fromQuery('id');
        $view = new ViewModel();
        $sidebarView = new ViewModel(array(
            'newposts' => $this->formatTargetPosts($this->postService->findAllPosts(0), false)
        ));
        $sidebarView->setTemplate('template/sidebar/sidebar_post.phtml');
        $view->addChild($sidebarView, '_sidebarView');

        $article = new ViewModel(array('article' => $this->postService->findPost($id)));
        $article->setTemplate('template/content/article.phtml');
        $view->addChild($article, '_article');
        return $view;
    }

    public function ajaxAction(){

//        echo "it is working for ajax";
        $pageIndex = $this->params()->fromQuery('page');
        $content =  $this->formatTargetPosts($this->postService->findAllPosts($pageIndex), true);
        $response = $this->getResponse();
        $response->setContent($content);
        return $response;
    }

    public function formatTargetPosts($array, $flag){

        $contentInUl = '';
        if($flag == true){
            foreach ($array as $item){
                $contentInUl .= "<li>
                            <i class=\"fa fa-plug\" aria-hidden=\"true\"></i> <a href='http://www.xulin-tan.de/blog/public/post/article?id=".$item['post_id']."'><h4>".$item['post_title']."</h4></a><br />
                            <p class='contentUnderTitle'>
                                <span class='glyphicon glyphicon-time'></span> 
                                <b>Posted on</b> ".$item['post_create_time']." <b>
                                   &nbsp;<i class=\"fa fa-tags\" aria-hidden=\"true\"></i>Category:</b> 
                                <a>".$item['post_category']."</a> 
                                    &nbsp;<i class=\"fa fa-user\" aria-hidden=\"true\"></i>
                                <b>Posted by</b> ".$item['user_name']."</p>
                        </li><br />";
                }
        }else{
            foreach ($array as $item){
                $contentInUl .= "<li>
                                    <a href='http://www.xulin-tan.de/blog/public/post/article?id=".$item['post_id']."'>
                                    <i class=\"fa fa-bell-o\" aria-hidden=\"true\"></i>
                                    <h5>".substr($item['post_title'],0,42)."...</h5></a>
                                </li>";
            }
        }

        return $contentInUl;
    }
}