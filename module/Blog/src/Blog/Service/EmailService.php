<?php
namespace Blog\Service;

//use Blog\Service\PostServiceInterface;
//use Blog\Model\Post;
class EmailService implements EmailServiceInterface{

//    protected $postService;

//    public function __construct(PostServiceInterface $postService){
//
//        $this->postService = $postService;
//    }

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

//        return $this->postService->test();
    }
}