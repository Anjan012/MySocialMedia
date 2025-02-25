<?php

  class Signup
  {

    Private $error = ""; // it is only accessed by the functions inside the classes 

    // This function can be access from the outside we put it public (it is by default)
    public function evaluate($data)
    {

      // data will come as an array
      foreach($data as $key => $value)
      {
        // chacking the value empty or not
        if(empty($value))
        {
          $this->error =  $this->error . $key . " is empty! <br>";
        }
        if($key == "email")
        {

          // preg amtch is a function it has regular expression
         if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$value))
         {
          $this->error =  $this->error . " invalid email address! <br>";
         }

        }
        
        if($key == "first_name")
        {

          // is numeric is a function
         if(is_numeric($value)) // if this is a numeric value 
         {
          $this->error =  $this->error . " first name cannot be a number! <br>";
         }
         if (strstr($value, " "))// it is  trur that it has a empty space then it will display 
         {
          $this->error = $this->error. "first name cannot have spaces! <br>";
         }

        }

        if($key == "last_name")
        {

          // is numeric is a function
         if(is_numeric($value))
         {
          $this->error =  $this->error . " last name cannot be a number! <br>";
         }

        }


      }

      // if there is no error
      if($this->error == "")
      {

        //no error create the user
        $this->create_user($data);

      }
      else
      {
        return $this->error;
      }


    }

    //creating function

    public function create_user($data)
    {

      // ucfirst() takes the first letter and capitalize it 
      $first_name = ucfirst($data['first_name']);
      $last_name = ucfirst($data['last_name']);
      $gender = $data['gender'];
      $email = $data['email'];
      $password = $data['password'];

      // create these
      $url_address = strtolower($first_name) . "." . strtolower($last_name);
      $userid = $this->create_userid();


      $query = "insert into users 
      (userid, first_name, last_name, gender, email, password,url_address) 
      values 
      ('$userid', '$first_name', '$last_name', '$gender', '$email', '$password','$url_address')";


      $DB = new Database(); // calling database from another class
      $DB->save($query);

    }

    private function create_userid()
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
  }

?>