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
                $adminContent = new ViewModel(array());
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
                $adminContent = new ViewModel(array());
                $adminContent->setTemplate('template/content/adminContent.phtml');
                $view->addChild($adminContent, '_admin_content');
                echo "login in and init session";
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

}