<?php
namespace Blog\Controller;

use Blog\Service\PostServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AdminController extends AbstractActionController{

    public function __construct(PostServiceInterface $postService){

        $this->postService = $postService;
    }

    public function indexAction(){
        echo "test";
    }
}