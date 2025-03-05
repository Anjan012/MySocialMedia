<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

session_start();

include("classes/connect.php");
include("classes/login.php");
include("classes/user.php");
include("classes/post.php");
include("classes/image.php");


// This will redirect us if we are not logged in
$login = new Login();
// capturing user data 
$user_data = $login->check_login($_SESSION['mybook_userid']);

// posting starts here 
// error 4 means no files found

if ($_SERVER['REQUEST_METHOD'] == "POST") {

  // echo '<pre>';
  // print_r($_POST);
  // print_r($_FILES);
  // echo '<pre>';

  // potential issue :  If the uploads/ directory does not have write permissions for the web server, the file can't be saved, and move_uploaded_file() will return false. Make sure that the directory is writable by the web server. For testing, you can try setting the directory permissions to 777, but it should be adjusted later for security. terminal : chmod 777 uploads


  if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != "") {

    // making sure that the file is correct and a valid file

    if ($_FILES['file']['type'] = "image/jpeg") {

      $allowed_size = (1024 * 1024) * 7;

      if ($_FILES['file']['size'] < $allowed_size) {

        // everything is file

        $filename = "uploads/" . $_FILES['file']['name'];


        // function that uploads the file 
        $temp = move_uploaded_file($_FILES['file']['tmp_name'], $filename);

        // after move the file i want to crop it
        $image = new Image();
        // $image->crop_image(orginal_image, cropped_image, 1000,1000);
        $image->crop_image($filename, $filename, 800,800);


        if (file_exists($filename)) {

          //chnage in database

          $userid = $user_data['userid'];
          $query = "update users set profile_image = '$filename' where userid = '$userid' limit 1";

          $DB = new Database();
          $DB->save($query);

          header("Location: profile.php");
          die;
        }
      } else {

        echo "<div style='text-align:center; font-size:12px; color:white; background-color:grey;'>";
        echo " <br> The following errors occured: <br>";
        echo "Only images of size 3mb or lower are allowed!";
        echo "</div>";
      }
    } else {

      echo "<div style='text-align:center; font-size:12px; color:white; background-color:grey;'>";
      echo " <br> The following errors occured: <br>";
      echo "Only images of Jpeg type are allowed!";
      echo "</div>";
    }
  } else {

    echo "<div style='text-align:center; font-size:12px; color:white; background-color:grey;'>";
    echo " <br> The following errors occured: <br>";
    echo "Please add a valid image!";
    echo "</div>";
  }
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
    width: 100px;
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
            <input type="file" name="file" />

            <input type="submit" id="post_button" value="Change">
            <br>
          </div>
        </form>

      </div>

    </div>
  </div>

</body>

</html>