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

        return new ViewModel(array(
            'posts' => $this->postService->postMapper
        ));
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