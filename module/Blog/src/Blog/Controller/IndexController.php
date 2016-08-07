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


class IndexController extends AbstractActionController{

    //@var \Blog\Service\PostServiceInterface
    protected $postService;

    public function __construct(PostServiceInterface $postService){

        $this->postService = $postService;
    }

    public function indexAction(){
        
        $view = new ViewModel(array(
            'posts' => $this->postService->postMapper,
        ));
        $layout = $this->layout();

        $headerView = new ViewModel(array('message' => 'header'));
        $headerView->setTemplate('template/header/header.phtml');

        $sidebarView = new ViewModel(array('allposts' => $this->formatTargetPosts($this->postService->findAllPosts(0))));
        $sidebarView->setTemplate('template/sidebar/sidebar.phtml');

        $layout->addChild($headerView, '_headerView');
        $view->addChild($sidebarView, '_sidebarView');

        return $view;
    }

    public function formatTargetPosts($array){

        $contentInUl = '';
        foreach ($array as $item){
            $contentInUl .= "<li><i class=\"fa fa-clock-o\" aria-hidden=\"true\"></i>
                                <a href='http://www.xulin-tan.de/blog/public/post/article?id=".$item['post_id']."'><span>".$item['post_create_time']."</span>
                                <i class=\"fa fa-bell\" aria-hidden=\"true\"></i>
                                <h4>".$item['post_title']."</h4></a>
                                <b>&nbsp;<i class=\"fa fa-tags\" aria-hidden=\"true\"></i>Category:<a>".$item['post_category']."</a></b>
                            </li>";
        }

        return $contentInUl;
    }
}