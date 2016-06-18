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

    public function __invoke($testPara){

        return "test Helper load: ". $testPara;
    }
}