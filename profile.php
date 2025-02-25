<?php

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

session_start();

include("classes/connect.php");
include("classes/login.php");
include("classes/user.php");
include("classes/post.php");

// check if the user is logged in 

if (isset($_SESSION['mybook_userid']) && is_numeric($_SESSION['mybook_userid'])) // isnumeric here you have to check that the people has not put any malicious software
{

  // assin it to the id 
  $id = $_SESSION['mybook_userid'];
  $login = new Login();
  $result = $login->check_login($id);

  if ($result) {

    // retrieve the data 
    $user = new User();
    $user_data = $user->get_data($id);

    // just in case checking 
    if (!$user_data) {
      // redirect
      header("Location: login.php");
      die;
    }
  } else {

    // redirect
    header("Location: login.php");
    die; // it gets die and don't load the rest of the page 
  }
} else {

  // redirect
  header("Location: login.php");
  die;
}

// posting starts here

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $post = new Post();
  $id = $_SESSION['mybook_userid'];
  $result = $post->create_post($id, $_POST);
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile | Mybook</title>
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
    margin-top: -200px;
    border-radius: 50%;
    border: solid 2px white;
  }

  #menu_buttons {
    width: 100px;
    /* div, img is a block which occupies entire so inline treat the div as text  here in inline block the box will move instead of getting cut */
    display: inline-block;
    margin: 2px;
  }

  #friends_img {
    width: 75px;
    /* float tell to warp around the img since the text is less so the img won't come down  */
    float: left;
    margin: 8px;
  }

  #friends_bar {
    background-color: white;
    min-height: 400px;
    margin-top: 20px;
    color: #aaa;
    padding: 8px;
  }

  #friends {
    /* clears the floating of previous item clear contains three parameter (left,right,both) but in this case both works fine  */
    clear: both;
    font-size: 12px;
    font-weight: bold;
    color: #405d9b;
  }

  textarea {
    width: 100%;
    border: none;
    /* we give again font-family cause it will get the parent font family  */
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size: 14px;
    height: 60px;
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
  <!-- This is the top blue bar code  -->
  <div id="blue_bar">
    <div style="margin:auto; width:800px; font-size:30px;">
      <!-- &nbsp  for space between -->
      Mybook &nbsp &nbsp <input type="text" id="search_box" placeholder="search for people">
      <img src="selfie.jpg" alt="profile" style="width: 50px; float:right;">
      <a href="logout.php">
        <span style="font-size: 11px; float:right; margin:10px; color:white;">logout</span>
      </a>
    </div>
  </div>

  <!-- cover Area -->
  <!-- if the content are less the min height will be 400px if more it will extend automatically  -->
  <div style="width:800px; margin:auto; min-height:400px;">
    <div style="background-color: white; text-align:center; color:#405d9b;">
      <img src="mountain.jpg" alt="cover" style="width: 100%;" ;>
      <img src="selfie.jpg" alt="profile" id="profile_pic"><br>
      <div style="font-size: 20px;">
        <?php echo $user_data['first_name'] . " " . $user_data['last_name'] ?>
      </div>
      <br>
      <div id="menu_buttons">Timeline </div>
      <div id="menu_buttons">About</div>
      <div id="menu_buttons">Friends</div>
      <div id="menu_buttons">Photos</div>
      <div id="menu_buttons">Settings</div>
    </div>

    <!-- Below cover area ------------- -->
    <!-- flex is the way to streach this to fill the space flex:1 for both equally streches share area equally but i want to flex twice as much to first div so flex 2.5 for second and 1 for the first-->
    <div style="display: flex;">
      <!-- friends area  -->
      <div style="min-height:400px; flex:1;">
        <div id="friends_bar">
          Friends <br>
          <div id="friends">
            <img src="user1.jpg" alt="user" id="friends_img"> <br>
            First User
          </div>

          <div id="friends">
            <img src="user2.jpg" alt="user" id="friends_img"> <br>
            Second User
          </div>

          <div id="friends">
            <img src="user3.jpg" alt="user" id="friends_img"> <br>
            African girl
          </div>

          <div id="friends">
            <img src="user4.jpg" alt="user" id="friends_img"> <br>
            African Dude
          </div>
        </div>

      </div>

      <!-- post area  -->
      <div style="min-height:400px; flex:2.5; padding:20px; padding-right:0;">

        <div style="border:solid thin #aaa; padding:10px; background-color:white;">
          <form method="post">
            <textarea name="post" placeholder="Whats on your mind?"></textarea>
            <input type="submit" id="post_button" value="Post">
          </form>
          <br>
        </div>

        <!-- posts  -->
        <div id="post_bar">

          <!-- post 1 -->
          <div id="post">

            <div>
              <img src="user1.jpg" alt="user" style="width: 75px; margin-right:4px;">
            </div>
            <div>
              <div style="font-weight: bold; color:#405d9b;">Fisrt Guy</div>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi odit hic consequuntur provident similique veniam in suscipit, nostrum expedita ipsam nobis ullam omnis.
              <br><br>
              <a href="">like</a> . <a href="">Comment </a>. <span style="color: #999;">Feburary 15 2025 </span>
            </div>

          </div>

          <!-- post 2 -->
          <div id="post">

            <div>
              <img src="user4.jpg" alt="user" style="width: 75px; margin-right:4px;">
            </div>
            <div>
              <div style="font-weight: bold; color:#405d9b;">African Dude</div>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi odit hic consequuntur provident similique veniam in suscipit, nostrum expedita ipsam nobis ullam omnis.
              <br><br>
              <a href="">like</a> . <a href="">Comment </a>. <span style="color: #999;">Feburary 15 2025 </span>
            </div>

          </div>

        </div>
      </div>
    </div>
  </div>

</body>

</html>