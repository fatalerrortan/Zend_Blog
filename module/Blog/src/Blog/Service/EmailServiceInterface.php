<?php
namespace Blog\Service;

use Blog\Model\EmailInterface;

interface EmailServiceInterface{

    public function emailGenerate($targetUser, $flag);
    public function registerEmail($targetUser);
    public function postEmail();
}