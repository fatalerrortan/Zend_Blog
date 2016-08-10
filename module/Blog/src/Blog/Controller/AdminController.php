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
                $adminContent = new ViewModel(array('posts' => $this->formatTargetPosts($this->postService->findAllPosts('', 'php'))));
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
                $adminContent = new ViewModel(array('posts' => $this->formatTargetPosts($this->postService->findAllPosts('', 'php'))));
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

    public function formatTargetPosts($array){

        $contentInUl = "<table class='table table-striped'><thead><th>Post_Id</th><th>Post_Create_Date</th><th>Post_Title</th></thead>";
//$contentInUl = '';
            foreach ($array as $item){
//
                $contentInUl .= "<tr>
                                   <td>".$item['post_id']."</td><td>".$item['post_create_time']."</td><td>".$item['post_title']."</td>
                                   <td><button><i class=\"fa fa-wrench\" aria-hidden=\"true\" style='color:blue'></i></button></td>
                                   <td><button><i class=\"fa fa-rocket\" aria-hidden=\"true\" style='color:green'></i></button></td>
                                    <td><button><i class=\"fa fa-times\" aria-hidden=\"true\" style='color:red'></i></button></td>
                                </tr>";


//                $contentInUl .= "<li>
//                            <i class=\"fa fa-plug\" aria-hidden=\"true\"></i> <a href='http://www.xulin-tan.de/blog/public/post/article?id=".$item['post_id']."'><h4>".$item['post_title']."</h4></a><br />
//                            <p class='contentUnderTitle'>
//                                <span class='glyphicon glyphicon-time'></span>
//                                <b>Posted on</b> ".$item['post_create_time']." <b>
//                                   &nbsp;<i class=\"fa fa-tags\" aria-hidden=\"true\"></i>Category:</b>
//                                <a>".$item['post_category']."</a>
//                                    &nbsp;<i class=\"fa fa-user\" aria-hidden=\"true\"></i>
//                                <b>Posted by</b> ".$item['user_name']."</p>
//                        </li><br />";
            }
        $contentInUl .= "</table>";

        return $contentInUl;
    }

}