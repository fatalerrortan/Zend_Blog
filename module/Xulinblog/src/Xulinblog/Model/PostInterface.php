<?php
/**
 * Created by PhpStorm.
 * User: FatalError
 * Date: 6/5/2016
 * Time: 12:06 AM
 */
 namespace Xulinblog\Model;

 interface PostInterface
 {
     /**
      * Will return the ID of the blog post
      *
      * @return int
      */
     public function getId();

     /**
      * Will return the TITLE of the blog post
      *
      * @return string
      */
     public function getTitle();

     /**
      * Will return the TEXT of the blog post
      *
      * @return string
      */
     public function getText();
 }