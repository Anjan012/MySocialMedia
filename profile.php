<?php

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

session_start();

include("classes/connect.php");
include("classes/login.php");
include("classes/user.php");
include("classes/post.php");

$login = new Login();
// capturing user data 
$user_data = $login->check_login($_SESSION['mybook_userid']);

// posting starts here

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $post = new Post();
  $id = $_SESSION['mybook_userid'];
  $result = $post->create_post($id, $_POST);

  // solving the problem when refresh son't store data in database of identical post
  if($result === '') // when we are posting something we are returning a error 
  {

    header("Location: profile.php");
    die;

  }else{

    echo "<div style='text-align:center; font-size:12px; color:white; background-color:grey;'>";
    echo "The following errors occured <br> <br> ";
    echo $result;
    echo "</div>";

  }
}

// collect posts

$post = new Post();
$id = $_SESSION['mybook_userid'];
$posts = $post->get_post($id);


// collect friends

$user = new User();
$id = $_SESSION['mybook_userid'];
$friends = $user->get_friends($id);

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
   <?php include('header.php'); ?>

  <!-- cover Area -->
  <!-- if the content are less the min height will be 400px if more it will extend automatically  -->
  <div style="width:800px; margin:auto; min-height:400px;">
    <div style="background-color: white; text-align:center; color:#405d9b;">
      <img src="mountain.jpg" alt="cover" style="width: 100%;" ;>
      <span style="font-size: 12x;">
        
      <?php

      $image = ''; // image is empty
      if(file_exists($user_data['profile_image'])){

        $image = $user_data['profile_image'];
      }

      ?>

      <img src="<?php echo $image ?>" alt="profile" id="profile_pic"> <br>

        <a href="change_profile_image.php" style="text-decoration: none; color:#f0f;">Change image </a>
      </span><br>
      <div style="font-size: 20px;">
        <?php echo $user_data['first_name'] . " " . $user_data['last_name'] ?>
      </div>
      <br>
      <a href="index.php"><div id="menu_buttons">Timeline </div> </a>
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

          <?php 

          if($friends){
            foreach($friends as $FRIEND_ROW)
            {
             
              include('user.php');

            }
          }
          ?>
          
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

          <?php 

          if($posts){
            foreach($posts as $ROW)
            {
              $user = new User();
              $ROW_USER = $user->get_user($ROW['userid']);
              // by doing this we can simply loop the posts
              include('post.php');

            }
          }
          ?>

        </div>
      </div>
    </div>
  </div>

</body>

</html>