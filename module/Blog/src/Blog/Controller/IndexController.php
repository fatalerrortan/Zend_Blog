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

//        $view = new ViewModel(array(
//            'posts' => $this->postService->postMapper,
//        ));
//        $view->setTemplate('foo/baz-bat/do-something-crazy');
        $view = new ViewModel();
        $headerView = new ViewModel(array('message' => 'header'));
        $headerView->setTemplate('template/header/header.phtml');

        $contentView = new ViewModel(array('message' => 'content'));
        $contentView->setTemplate('template/content/content.phtml');

        $sidebarView = new ViewModel(array('message' => 'sidebar'));
        $sidebarView->setTemplate('template/sidebar/sidebar.phtml');

        $footerView = new ViewModel(array('message' => 'footer'));
        $footerView->setTemplate('template/footer/footer.phtml');

        $view->addChild($headerView, '_headerView')
            ->addChild($contentView, '_contentView')
            ->addChild($sidebarView, '_sidebarView')
            ->addChild($footerView, '_footerView');
        
        return $view;
    }

    public function addAction()
    {
        echo "test";
    }

    public function editAction()
    {
    }

    public function deleteAction()
    {
    }
}