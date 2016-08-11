<?php
/**
 * Created by PhpStorm.
 * User: FatalError
 * Date: 6/18/2016
 * Time: 2:55 AM
 */
namespace Blog\View\Helper;

use Zend\View\Helper\AbstractHelper;

class loadCategory extends AbstractHelper{

    public function __invoke(){

        $category = array(

                'php' => array(
                    0 => 'php',
                    1 => 'magento',
                    2 => 'zendframework'
                ),
                'javascript' => array(
                    0 => 'javascript',
                    1 => 'jquery',
                ),
                'html' => array(
                    0 => 'html'
                ),
                'css' => array(
                    0 => 'css'
                ),
                'database' => array(
                    0 => 'database'
                ),
                'linux' => array(
                    0 => 'desktop',
                    1 => 'server',
                ),
                'Curriculum vitae' => array(
                    0 => 'Curriculum vitae',
                ),
        );
        $html = '';
        foreach ($category as $key => $value){

                $html .= "<li class='dropdown'>";
                $html .= "<a href=".$value." class=\"dropdown-toggle\" data-toggle=\"dropdown\">".$key."<b class=\"caret\"></b></a>";
                $html .= " <ul class=\"dropdown-menu\">";
                foreach ($value as $item){
                    $html .= "<li>";
                    $html .= "<a href='http://www.xulin-tan.de/blog/public/posts/index?category=".$item."'>".$item."</a>";
                    $html .= "</li>";
                }
                $html .= "</ul></li>";
        }

        return $html;
    }
}