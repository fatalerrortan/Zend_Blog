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

        $sidebarView = new ViewModel(array('message' => 'sidebar'));
        $sidebarView->setTemplate('template/sidebar/sidebar.phtml');

        $layout->addChild($headerView, '_headerView');
        $view->addChild($sidebarView, '_sidebarView');

        return $view;
    }

    public function testAction(){
        echo "testController";
    }
}