<?php
namespace Blog\Service;

use Blog\Model\EmailInterface;

interface EmailServiceInterface{

    public function emailGenerate($targetUser);
}