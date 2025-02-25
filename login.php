<?php
session_start();
include("classes/connect.php");
include("classes/login.php");

$email = "";
$password = "";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $login = new Login();
  $result = $login->evaluate($_POST);


  // if the result is not empty it means there is an error  
  if ($result != "") {
    echo "<div style='text-align:center; font-size:12px; color:white; background-color:grey;'>";
    echo "The following errors occured <br> <br> ";
    echo $result;
    echo "</div>";
  } else {
    // redirect to profile.php if there is no error 
    header("Location: profile.php");
    die; // it ensure a clear break good practice once it runs it doesnot runs any thing after this
  }

  // This will be set 

  $email = $_POST['email'];
  $password = $_POST['password'];
}

?>


<!-- A tag is a like a container , tag shouldnot be display to the user, closing tg tells where the content end -->

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- head tag content the info about the website  -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mybook | Log in</title>
</head>
<style>
  #bar {
    height: 100px;
    background-color: #3c5a99;
    color: #d9dfeb;
    padding: 4px;
  }

  #signup_button {
    background-color: #42b72a;
    width: 70px;
    text-align: center;
    padding: 4px;
    border-radius: 4px;
    float: right;
  }

  #bar2 {
    background-color: white;
    width: 800px;
    margin: auto;
    margin-top: 50px;
    padding: 10px;
    padding-top: 50px;
    text-align: center;
    font-weight: bold;
  }

  #text {
    height: 40px;
    width: 300px;
    border-radius: 4px;
    border: solid 1px #ccc;
    padding: 4px;
    font-size: 14px;
  }

  #button {
    width: 300px;
    height: 40px;
    border-radius: 4px;
    border: none;
    background-color: #3c5a99;
    color: #fff;
    font-weight: bold;
  }
</style>
<!-- body tag contains the content view by the user  -->

<body style="font-family: tahoma; background-color:#e9ebee;">
  <!-- div is a box  -->
  <!-- height is a property  -->
  <div id="bar">
    <div style="font-size: 40px;">Mybook </div>
    <div id="signup_button">Signup </div>
  </div>
  
  <form method="post"> 
    <!-- margin is the distance between the object ant the next object  -->
    <div id="bar2">
      Login to myBook <br> <br>
      <input name="email" value="<?php echo $email ?>" type="text" id="text" placeholder="Email"> <br> <br>
      <input name="password" value="<?php echo $password ?>" type="password" id="text" placeholder="Password"> <br> <br>
      <input type="submit" id="button" value="Log in">
      <br> <br> <br> <br>
    </div>
  </form>

</body>

</html>