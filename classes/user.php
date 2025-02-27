<?php

  class User
  {

    public function get_data($id)
    {

      $query = "select *from users where userid = '$id' limit 1";
      $DB = new Database();
      $result = $DB->read($query);

      if($result)
      {

        $row = $result[0]; // assign the first row 
        return $row;
        
      }else{

        return false;

      }

    }

    public function get_user($id)
    {

      $query = "select *from users where userid = '$id' limit 1";
      $DB = new Database();
      $result = $DB->read($query);

      if($result) // we get result
      {
        return $result[0]; // this is going to be an array so we just want the first one 
      }else{

        return false;

      }

    }

    public function get_friends($id)
    {

      $query = "select *from users where userid != '$id' "; // my friends are not me so get everyone who is not me
      
      $DB = new Database();
      $result = $DB->read($query);

      if($result) // we get result
      {
        return $result; // since there is going to be multiple friends we will not put $result[0]

      }else{

        return false;

      }

    }

  }

?>