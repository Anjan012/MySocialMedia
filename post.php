<?php


?>

<div id="post">

  <div>
    <?php

      $image = "images/user_male.png";
      if($ROW_USER['gender']== "Female")
      {
        $image = "images/user_female.jpgg";
      }

    ?>
    <img src="<?php echo $image?>" alt="user" style="width: 75px; margin-right:4px;">
  </div>
  <div>
    <div style="font-weight: bold; color:#405d9b;"><?php echo $ROW_USER['first_name'] . ' '. $ROW_USER['last_name'] ?></div>
      <?php echo $ROW['post'] ?>
    <br><br>
    <a href="">like</a> . <a href="">Comment </a>. <span style="color: #999;"> <?php echo $ROW['date'] ?> </span>
  </div>

</div>