<?php
namespace Blog\Service;

//use Blog\Model\Post;
class EmailService implements EmailServiceInterface{

    public function emailGenerate($targetUser, $flag){

        switch ($flag) {
            case "user_register_email":
                if($this->registerEmail($targetUser)){
                return true;
                }
                break;
            case "user_new_post_email":
                echo "Your favorite color is blue!";
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

    public function postEmail(){

    }
}