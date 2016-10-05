<?php
namespace Blog\Service;

//use Blog\Model\EmailInterface;
use Blog\Service\PostServiceInterface;

interface EmailServiceInterface{

    public function emailGenerate($targetUser, $content, $flag);
    public function registerEmail($targetUser);
    public function postEmail($title);
    public function sendTweet($param);
}