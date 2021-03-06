<?php
namespace Blog\Service;
//use Blog\Model\Post;
class PostService implements PostServiceInterface{
    /**
     * @var \Blog\Mapper\PostMapperInterface
     */
    public $postMapper;
    /**
     * @param PostMapperInterface $postMapper
     */

    public function __construct(){

//        file_put_contents('./test.log',__DIR__);
        $local = explode(',', file_get_contents('/homepages/2/d558391257/htdocs/local.txt'));
        $host_name  = $local[0];
        $database   = $local[1];
        $user_name  = $local[2];
        $password   = $local[3];
        $connect = mysqli_connect($host_name, $user_name, $password, $database);
        if(mysqli_connect_errno()) {
            die('Connect Error!!!');
        }else{
            $this->postMapper = $connect;
        }
    }

    public function findAllPosts($pageIndex, $category, $pattern){

        if(!empty($pattern)){
            $sql_query = "SELECT * 
                      FROM blog_post
                      WHERE post_title LIKE '%$pattern%'  
                      ORDER BY post_create_time DESC";
        }else{
        $cateList = array('php','javascript','html','css','database','linux');
        if(!empty($category)){
            if(in_array($category, $cateList)){
                $sub_query = $category."%";
            }else{
                $sub_query = "%".$category;
            }
            $sql_query = "SELECT * 
                      FROM blog_post
                      WHERE post_category LIKE '$sub_query' 
                      ORDER BY post_create_time DESC";
        }else{
            if($pageIndex == 0){$pageIndexHead = 0;}
            else{$pageIndexHead = $pageIndex * 11 - 1;}
            $pageScope = 10;
            $sql_query = "SELECT * 
                      FROM blog_post
                      ORDER BY post_create_time DESC
                      LIMIT $pageIndexHead,$pageScope";
            }
        }
        $query = mysqli_query($this->postMapper, $sql_query);
        $result = mysqli_fetch_all($query);
        $keys = array('post_id', 'post_category', 'post_title', 'post_article', 'post_keyword', 'post_status', 'user_name', 'post_create_time', 'post_update_time', 'post_comment_id');
        $formatArray = $this->setKeyForSubArray($keys, $result);
//        $endContent = $this->formatTargetPosts($formatArray);
        return $formatArray;
    }

    public function findPost($id){
        // TODO: Implement findPost() method.
        $sql_query = "SELECT *
                      FROM blog_post
                      WHERE post_id = '$id'";
        $query = mysqli_query($this->postMapper, $sql_query);
        $urResult = mysqli_fetch_all($query);
        $keys = array('post_id', 'post_category', 'post_title', 'post_article', 'post_keyword', 'post_status', 'user_name', 'post_create_time', 'post_update_time', 'post_comment_id');

        return $this->setKeyForSubArray($keys, $urResult);
    }

    public function userMapping($username, $password){

        $sql_query = "SELECT *
                      FROM blog_user
                      WHERE user_name = '$username' AND user_password = '$password' AND user_privilege = '0'";
        $query = mysqli_query($this->postMapper, $sql_query);
        $result = mysqli_fetch_all($query);
        if(empty($result)){return false;}
        else{return true;}
    }

    public function dbUpdate($id, $content, $category, $keyword, $title){

        $query = "UPDATE blog_post
                  SET post_article = '$content', post_category = '$category', post_keyword = '$keyword', post_title = '$title'  
                  WHERE post_id = '$id'";
        if( mysqli_query($this->postMapper, $query)){
            return true;
        }else{
            return false;
        }
    }

    public function dbSave($content, $title, $category, $tags){

        $query = "INSERT INTO blog_post (post_category, post_title, post_article, post_keyword, post_status, user_name)
                  VALUES ('$category', '$title', '$content', '$tags', 'active', 'Xulin Tan')";
        if( mysqli_query($this->postMapper, $query)){
            return true;
        }else{return false;}
    }

    public function dbPush($post_id){

        $Current_timestamp = date("Y-m-d H:i:s");
        $query = "UPDATE blog_post
                  SET post_create_time = '$Current_timestamp'  
                  WHERE post_id = '$post_id'";
        if( mysqli_query($this->postMapper, $query)){
            return true;
        }else{
            return false;
        }
    }

    public function dbDelete($post_id){

        $query = "DELETE FROM blog_post
                WHERE post_id = '$post_id'";
        if( mysqli_query($this->postMapper, $query)){
            return true;
        }else{return false;}
    }

    public function userInsert($user_email){

        $query = "INSERT INTO blog_user (user_name, user_privilege)
                  VALUES ('$user_email','2')";
        if( mysqli_query($this->postMapper, $query)){
            return 'Got it :) you will receive a Email soon!';
        }else{return false;}
    }
//    public function insertTest(){
//        $test = file_get_contents($_SERVER['DOCUMENT_ROOT']."/blog/public/test/insertTest.txt");
////        $test = "dsfdsfjdlskfjsdklfjsdlfjgjdlgdflgkjhflkdfjhgdkljfghkjghdfkjghfgkljh";
//        for ($i=0; $i <= 3; $i++){
//            $sql = "INSERT INTO blog_post (post_category, post_title, post_article, post_keyword, post_status, user_name)
//                  VALUES ('database', 'postTitle".$i."', '$test', 'database', 'active', 'Xulin Tan')";
//            if(!mysqli_query($this->postMapper, $sql)){
//                die(mysqli_error($this->postMapper));
//            }
//        }
//        mysqli_close($this->postMapper);
//        return 'down';
//    }

    public function setKeyForSubArray($keys, $urArray){
        $formatArray = array();
        foreach ($urArray as $subArray){
            $newSubArray = array_combine($keys,$subArray);
            $formatArray[] = $newSubArray;
        }
        return $formatArray;
    }

    public function test(){
         return 'test';
    }
}