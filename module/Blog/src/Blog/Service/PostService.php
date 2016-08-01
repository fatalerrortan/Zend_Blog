<?php
namespace Blog\Service;

use Blog\Model\Post;

class PostService implements PostServiceInterface{
    /**
     * @var \Blog\Mapper\PostMapperInterface
     */
    public $postMapper;

    /**
     * @param PostMapperInterface $postMapper
     */
    public function __construct(){



        $connect = mysqli_connect($host_name, $user_name, $password, $database);
        if(mysqli_connect_errno()) {
         die('Connect Error!');
        }else{
            $this->postMapper = $connect;
        }
    }

    public function findAllPosts(){
//        ORDER BY post_create_time DESC
//        TODO: Implement findAllPosts() method.
        $sql_query = "SELECT * 
                      FROM blog_post
                      ORDER BY post_create_time DESC
                      LIMIT 10
                      ";
        $query = mysqli_query($this->postMapper, $sql_query);
        $result = mysqli_fetch_all($query);
        $keys = array('post_id', 'post_category', 'post_title', 'post_article', 'post_keyword', 'post_status', 'user_name', 'post_create_time', 'post_update_time', 'post_comment_id');
        $formatArray = $this->setKeyForSubArray($keys, $result);
        return $formatArray;
    }

    public function findPost($id){
        // TODO: Implement findPost() method.
        return 'single post'. $id;
    }

    public function insertTest(){

        $test = file_get_contents($_SERVER['DOCUMENT_ROOT']."/blog/public/test/insertTest.txt");
//        $test = "dsfdsfjdlskfjsdklfjsdlfjgjdlgdflgkjhflkdfjhgdkljfghkjghdfkjghfgkljh";


        for ($i=0; $i <= 3; $i++){

            $sql = "INSERT INTO blog_post (post_category, post_title, post_article, post_keyword, post_status, user_name)
                  VALUES ('database', 'postTitle".$i."', '$test', 'database', 'active', 'Xulin Tan')";

            if(!mysqli_query($this->postMapper, $sql)){
                die(mysqli_error($this->postMapper));
            }
        }

        mysqli_close($this->postMapper);
    return 'down';
    }

    public function setKeyForSubArray($keys, $urArray){

        $formatArray = array();
        foreach ($urArray as $subArray){
            $newSubArray = array_combine($keys,$subArray);
            $formatArray[] = $newSubArray;
        }
        return $formatArray;
    }
}