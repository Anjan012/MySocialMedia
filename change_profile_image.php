<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

session_start();

include("classes/connect.php");
include("classes/login.php");
include("classes/user.php");
include("classes/post.php");

// This will redirect us if we are not logged in
$login = new Login();
// capturing user data 
$user_data = $login->check_login($_SESSION['mybook_userid']);

// posting starts here 
// error 4 means no files found

if ($_SERVER['REQUEST_METHOD'] == "POST"){

  echo '<pre>';
  print_r($_POST);
  print_r($_FILES);
  echo '<pre>';

  // function that uploads the file 

}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Change Profile Image| Mybook</title>
</head>
<style>
  #blue_bar {
    height: 50px;
    background-color: #405d9b;
    color: #d9dfeb;
  }

  #search_box {
    width: 400px;
    height: 20px;
    border-radius: 5px;
    border: none;
    padding: 4px;
    font-size: 14px;
    background-image: url(search.png);
    background-repeat: no-repeat;
    background-position: right;
  }

  #profile_pic {
    width: 150px;
    border-radius: 50%;
    border: solid 2px white;
  }

  #post_button {
    float: right;
    background-color: #405d9b;
    border: none;
    color: white;
    padding: 4px;
    font-size: 14px;
    border-radius: 2px;
    width: 50px;
  }

  #post_bar {
    margin-top: 20px;
    background-color: white;
    padding: 10px;

  }

  #post {
    padding: 4px;
    font-size: 13px;
    display: flex;
    margin-bottom: 20px;
  }
</style>

<body style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color:#d0d8e4">
  <br>
  <?php include('header.php'); ?>

  <!-- cover Area -->
  <!-- if the content are less the min height will be 400px if more it will extend automatically  -->
  <div style="width:800px; margin:auto; min-height:400px;">


    <!-- Below cover area ------------- -->
    <!-- flex is the way to streach this to fill the space flex:1 for both equally streches share area equally but i want to flex twice as much to first div so flex 2.5 for second and 1 for the first-->
    <div style="display: flex;">
     

      <!-- post area  -->
      <div style="min-height:400px; flex:2.5; padding:20px; padding-right:0;">

      <!-- if you are going to upload images you have to set enctype="multipart/form-data" if you son't so this you will not be able to upload image of any kind -->
      <form action="" method="post" enctype="multipart/form-data">
        <div style="border:solid thin #aaa; padding:10px; background-color:white;">
          <input type="file" name="file"/> 

          <input type="submit" id="post_button" value="Post">
          <br>
        </div>
      </form>

      </div>
      
    </div>
  </div>

</body>

</html>