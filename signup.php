<!-- A tag is a like a container , tag shouldnot be display to the user, closing tg tells where the content end -->

<?php

include("classes/connect.php");
include("classes/signup.php");

  $first_name = "";
  $last_name = "";
  $gender = "";
  $email = "";


  if($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    $signup = new Signup();
    $result = $signup->evaluate($_POST);

    if($result != "")
    {
      echo "<div style='text-align:center; font-size:12px; color:white; background-color:grey;'>";
      echo "The following errors occured <br> <br> ";
      echo $result;
      echo "</div>";
      
    }
    else
    {
      // redirect to login.php if there is no error 
      header("Location: login.php");
      die; // it ensure a clear break good practice once it runs it doesnot runs any thing after this
    }

  // This will be set 

  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $gender = $_POST['gender'];
  $email = $_POST['email'];


    
  }



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- head tag content the info about the website  -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mybook | Signup</title>
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

<body style="font-family: tohoma; background-color:#e9ebee;">
  <!-- div is a box  -->
  <!-- height is a property  -->
  <div id="bar">
    <div style="font-size: 40px;">Mybook </div>
    <div id="Log in">Signup </div>
  </div>

  <!-- margin is the distance between the object ant the next object  -->
  <div id="bar2">
    Sign up to Mybook <br> <br>

    <form action="signup.php" method="post">

      <input value="<?php echo $first_name ?>" name="first_name" type="text" id="text" placeholder="First name"> <br> <br>
      <input value="<?php echo $last_name ?>"  name="last_name" type="text" id="text" placeholder="Last name"> <br> <br>

      <span style="font-weight: normal;">Gender: </span><br> <br>
      <select name="gender" id="text">
        <option> <?php echo $gender ?> </option>
        <option>Male</option>
        <option>Female</option>
      </select>
      <br><br>

      <input value="<?php echo $email ?>"  name="email" type="text" id="text" placeholder="Email"> <br> <br>


      <input name="password" type="password" id="text" placeholder="Password"> <br> <br>
      <input name="password2" type="password" id="text" placeholder="Retype Password"> <br> <br>
      <input type="submit" id="button" value="Sign Up">
      <br> <br> <br> <br>

    </form>
  </div>

</body>

</html>