<?php
  session_start();

  //default-- not logged in
  $uid = 'Guest';

  if(isset($_SESSION['uid'])) {
    $uid = $_SESSION['uid'];
  }

  $_SESSION['uid'] = $uid;

  /* Display whether the user is logged in or not (and display relevant links*/

  if(strcmp($uid, 'Guest') == 0) {
    echo 'Not currently logged in (Guest).<br><br>';
    echo '<a href = "login.html">Click here to log in</a><br><br>';
  } else {
    echo 'Logged in as '.$uid.'<br><br>';
    echo '<a href="logout_process.php">Click here to sign out </a><br><br>';
  }
?>
