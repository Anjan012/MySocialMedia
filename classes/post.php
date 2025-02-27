<?php

  class Post{

    private $error = '';
    public function create_post($userid, $data)
    {

      if(!empty($data['post']))
      {

        $post = addslashes($data['post']);// so that we can escape any special character that the user has added before we add to the database

        $postid = $this->create_postid();

        $query = "insert into posts (userid,postid,post) values ('$userid','$postid','$post')";

        $DB = new Database();
        $DB->save($query);

      }else{

        $this->error .= "Please type something to post! <br>";

      }
      return $this->error;

    }

    private function create_postid()
    {

      $length = rand(4,19); // random number between 4 - 19
      $number = "";
      for($i = 0; $i < $length; $i++)
      {
        $new_rand = rand(0,9);
        $number = $number . $new_rand;
        
      }

      return $number;
      
    }

    public function get_post($id)
    {


      $query = "select * from posts where userid = '$id' order by id desc"; // we will not put limit here cause we want to retrieve all post 

        $DB = new Database();
        $result = $DB->read($query);
        if($result)
        {
          return $result;
        }else{
          return false;
        }

    }

  }

?>