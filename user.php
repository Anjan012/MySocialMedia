<div id="friends">

<?php

      $image = "images/user_male.png";
      if($FRIEND_ROW['gender']== "Female")
      {
        $image = "images/user_female.jpg";
      }

    ?>

  <img src="<?php echo $image ?>" alt="user" id="friends_img"> <br>
  <?php echo $FRIEND_ROW['first_name'] . " " . $FRIEND_ROW['last_name'] ?>
</div>