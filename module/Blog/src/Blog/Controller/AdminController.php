<?php
namespace Blog\Controller;

use Blog\Service\PostServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Zend\Session\SessionManager;
Use Zend\Session\Config\SessionConfig;


class AdminController extends AbstractActionController{

    public function __construct(PostServiceInterface $postService){

        $this->postService = $postService;
    }

    public function indexAction(){

        $view = new ViewModel();
        $username = $this->params()->fromPost('username');
        $password = $this->params()->fromPost('password');

        if(empty($username) && empty($password)){

            $session = new Container('user_session');
            $pattern = $session->offsetGet('session_status');
            if(!empty($pattern)){
                $adminContent = new ViewModel(array('posts' => $this->formatTargetPosts($this->postService->findAllPosts('', 'php'),true)));
                $adminContent->setTemplate('template/content/adminContent.phtml');
                $view->addChild($adminContent, '_admin_content');
                return $view;
            }else{
                echo "<h1>Forbidden No Session stored!</h1>
                    <button id=\"retry_1\" type=\"button\" class=\"btn btn-success\">To login Site</button>";
            }
        }else{
            $result = $this->postService->userMapping($username, $password);
            if($result){
                $this->sessionAction($username);
                $adminContent = new ViewModel(array('posts' => $this->formatTargetPosts($this->postService->findAllPosts('', 'php'),true)));
//
                $adminContent->setTemplate('template/content/adminContent.phtml');
                $view->addChild($adminContent, '_admin_content');
                //        TODO: Implement Admin Content.


            }else{
                $error_message = new ViewModel(array());
                $error_message->setTemplate('template/error/error_admin_login.phtml');
                $view->addChild($error_message, '_error_message');
            }

            return $view;
        }
    }

    public function ajaxAction(){

        $category = $this->params()->fromQuery('category');
        $content =  $this->formatTargetPosts($this->postService->findAllPosts('', $category),true);
        $response = $this->getResponse();
        $response->setContent($content);
        return $response;
    }

    public function editAction(){

        $post_id = $this->params()->fromQuery('post_id');
        if(!empty($post_id)){
            $resultArray = $this->postService->findPost($post_id)[0][0];
            $view = new ViewModel(array(
                'toEdit' => $resultArray,
            ));
            return $view;
        }else{
            $view = new ViewModel();
            return $view;
        }
    }

    public function pushAction($post_id){


    }

    public function dropAction($post_id){


    }

    public function loginAction(){

        $view = new ViewModel();
        return $view;
    }

    public function sessionAction($username){

        $sessionConfig = new SessionConfig();
        $sessionConfig->setOptions(array(
            'use_cookies' => true,
            'cookie_httponly' => true,
            'gc_maxlifetime' => 1800,
            'cookie_lifetime' =>1800,
        ));
        $manager = new SessionManager($sessionConfig);
        $session = new Container('user_session', $manager);
        $session->offsetSet('session_status', $username);

        return true;
    }

    public function adminpostAction($category){


    }

    public function formatTargetPosts($array,$flag){
        $contentInUl = '';
        if($flag == true){
            $contentInUl .= "<table class='table table-striped'><thead><th>Post_Id</th><th>Post_Create_Date</th><th>Post_Title</th></thead>";
//$contentInUl = '';
            foreach ($array as $item){
//
                $contentInUl .= "<tr>
                                   <td>".$item['post_id']."</td><td>".$item['post_create_time']."</td><td>".$item['post_title']."</td>
                                   <td><a href='http://www.xulin-tan.de/blog/public/admin/edit?post_id=".$item['post_id']."'><button><i class=\"fa fa-wrench\" aria-hidden=\"true\" style='color:blue'></i></button></a></td>
                                   <td><a href='http://www.xulin-tan.de/blog/public/admin/push?post_id=".$item['post_id']."'><button><i class=\"fa fa-rocket\" aria-hidden=\"true\" style='color:green'></i></button></a></td>
                                    <td><a href='http://www.xulin-tan.de/blog/public/admin/drop?post_id=".$item['post_id']."'><button><i class=\"fa fa-times\" aria-hidden=\"true\" style='color:red'></i></button></a></td>
                                </tr>";
            }
        $contentInUl .= "</table>";
        }else{
            foreach ($array as $item){
                $contentInUl .= $item['post_article'];
            }
        }

        return $contentInUl;
    }

}