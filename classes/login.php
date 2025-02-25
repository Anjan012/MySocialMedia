<?php

  class Login{

    private $error = "";

    // This is a public method (function) called evaluate. It's going to accept $data as input, which is expected to be an array with at least two keys: email and password.
    public function evaluate($data)
    {

      // addlashes: escape certain strings \ look for the specialcharacter and adds \ automatically, it also adds security cause some people can add malicious software using these special character and you would not even know about it 
      // These two lines take the email and password values from the $data array and escape any special characters using addslashes(). This helps prevent issues like SQL injection, where malicious users might try to harm your database by entering special characters (like quotes).
      $email = addslashes($data['email']);
      $password = addslashes($data['password']);

      // limit 1 : just return the one row the first one that it finds  
      $query = "select * from users where email = '$email' limit 1";


      $DB = new Database(); // calling database from another class
      $result = $DB->read($query); // read is returning so we store it in the variable , $result is a variable that holds the data fetched from the database.

      // if we do get the result that means the user exist 
      if($result)
      {

        $row = $result[0]; // This line stores that first row of data into the $row variable,  it is an associative array. 

        if($password == $row['password']) // $row['password'] accesses the password field from the $row array.
        {

          // create session data
          // session is a global variable that can be accssess from anywhere from your system (any class, function and soon.) in order to session to work we need to start the session so i have start the session in the login page  session_start is a funtion
          // session is an array of information (associative)

          // userid is the memory location, session will expire dependinding upon how the setting is set however if you are using the browser it will remain there for eg if you close the brower and open after some days or whatever the session  might have expire 

          // just to avoid collision it is better to name the session as the website name (prefix)
          $_SESSION['mybook_userid'] = $row['userid'];  // this gloabal will be avaiable whatever page you open as long as it is the sam browser, using session we can move inforamation between pages of same website

        }else{

          $this->error .= "Wrong Password!";
        }
  

      }else{

        $this->error .= "NO such email was found!";
      }

      return $this->error;

    }

    public function check_login($id)
    {

      // limit 1 : for one record 
       $query = "select userid from users where userid = '$id' limit 1";


       $DB = new Database(); 
       $result = $DB->read($query); 
 
       if($result)
       {

          return true; // user found (exist)

       }

       return false;

    }

  }

?>