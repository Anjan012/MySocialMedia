<?php

  session_start();

  if(isset($_SESSION['mybook_userid']))
  {

    // remove the id
    $_SESSION['mybook_userid'] = null;
    unset($_SESSION['mybook_userid']);

  }


  // header('Location: login.php');
  die;


?>