<?php
namespace Blog\Service;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventManager;
use Zend\EventManager\EventManagerAwareInterface;

class EmailService implements EmailServiceInterface, EventManagerAwareInterface{

    protected $events;

    public function setEventManager(EventManagerInterface $events){

        $events->setIdentifiers(array(
            __CLASS__,
            get_called_class(),
        ));
        $this->events = $events;
        return $this;
    }

    public function getEventManager(){

        if (null === $this->events) {
            $this->setEventManager(new EventManager());
        }
        return $this->events;
    }

    public function emailGenerate($targetUser, $title, $flag){

        switch ($flag) {
            case "user_register_email":
                if($this->registerEmail($targetUser)){
                return true;
                }
                break;
            case "user_new_post_email":
//                return $this->postEmail($title);
                break;
            default:
                echo "Your favorite color is neither red, blue, nor green!";
        }
    }

    public function registerEmail($targetUser){

        $html = file_get_contents('/homepages/2/d558391257/htdocs/blog/module/Blog/view/template/email/registerEmail.html');
        $header  = "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $header .= "From: tiemann9898@gmail.com\r\n";
        $header .= "Reply-To:  tiemann9898@gmail.com\r\n";
// $header .= "Cc: $cc\r\n";  // falls an CC gesendet werden soll
        $header .= "X-Mailer: PHP ". phpversion();
        mail( $targetUser, 'Newsletter From Xulin Study Blog', $html, $header);
        return true;
    }

    public function postEmail($title){

        echo "tigger a post!";
        $this->getEventManager()->trigger(__FUNCTION__, $this, array('content' => $title));
    }

    public function sendTweet($param){

        echo "trigger a Tweet";
        $this->getEventManager()->trigger(__FUNCTION__, $this, array('content' => $param));
    }
}