<?php
/**
 * Created by PhpStorm.
 * User: FatalError
 * Date: 5/19/2016
 * Time: 1:31 AM
 */
namespace Blog\Controller;

use Blog\Service\PostServiceInterface;
use Blog\Service\EmailServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;



class IndexController extends AbstractActionController{

    //@var \Blog\Service\PostServiceInterface
    protected $postService;
    protected $emailService;

    public function __construct(PostServiceInterface $postService, EmailServiceInterface $emailService){

        $this->postService = $postService;
        $this->emailService = $emailService;

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

//        $this->emailService->postEmail("this is a Post");
        $this->emailService->sendTweet("this is a Tweet");

//        $this->emialService->getEventManager()->attach('testEmail', function ($e) use ($log) {});

        return $view;
    }

    public function userinitAction(){

        $response = $this->getResponse();
        $user_email = $this->params()->fromPost('user_email');
//        $result = $this->postService->userInsert($user_email);
//        if($result){
//            $response->setContent($result);
//            $this->emailService->emailGenerate($user_email, 'user_register_email');
//        }else{
//            $response->setContent('Failed');
//        }
        $response->setContent($user_email);
        return $response;
    }

    public function formatTargetPosts($array){

        $contentInUl = '';
        foreach ($array as $item){
            if(strpos($item['post_category'], ',') != false){
                $category = str_replace(',','',strstr($item['post_category'],','));
            }else{$category = $item['post_category'];}
            $contentInUl .= "<li><i class=\"fa fa-clock-o\" aria-hidden=\"true\"></i>
                                <a href='http://www.xulin-tan.de/blog/public/posts/article?id=".$item['post_id']."'><span>".$item['post_create_time']."</span>
                                <i class=\"fa fa-bell\" aria-hidden=\"true\"></i>
                                <h4>".$item['post_title']."</h4></a>
                                <b>&nbsp;<i class=\"fa fa-tags\" aria-hidden=\"true\"></i>Category:<a>".$category."</a></b>
                            </li>";
        }

        return $contentInUl;
    }
}