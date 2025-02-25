<?php

  // if this was online you would put server address in host 127... or facebook.com (server name) but here we are in local machine
  // $host = "localhost";
  // $username = "root";
  // $password = "";
  // $db = "mybook_db";

  // this variable will create a connection to our database (i is the new version of mysql in php)
  // $connection = mysqli_connect($host,$username,$password,$db); // msqli_connect() is a function
  

  // for portablility and resuablity 

  class Database
  {
    // if a variable only function inside the class private only inside but for public outside the class

    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "mybook_db";

    function connect(){


      $connection = mysqli_connect($this->host,$this->username,$this->password,$this->db); // accessed here 

      // here we cannot asscess this fuction variable to another so we have to add a return return means exit the function with $connection
      return $connection;

    }

    function read($query){

      // calling the function inside the class use this 
      $conn = $this->connect();
      $result = mysqli_query($conn, $query);

      if(!$result){
        return false;
      }
      else
      {

        $data = [];

        while($row = mysqli_fetch_assoc($result))
        {
          $data[] =  $row;
        }

        return $data;

      }

    }

    function save($query){
      $conn = $this->connect();
      $result = mysqli_query($conn, $query);

      if(!$result){
        return false;
      }
      else{
        return true;
      }

    }
  }

?>
