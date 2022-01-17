<html>
  <h2>Welcome to our Gates of RAM Forum!<br><br></h2>
  <h3>The purpose of this forum is to ask technical questions and share technical experiences/solutions. Here is the main page of the forum!<br><br></h3>
  <body style = "background-color: silver">

<?php
    session_start();

    // Make sure that the username and password is correct. 
    // Possibly add more links (e.g. to all the messages and to add newmessage.php as a redirect)

    //default-- not logged in
    $uid = 'Guest';

    if(isset($_SESSION['uid'])) {
      $uid = $_SESSION['uid'];
    }

    $_SESSION['uid'] = $uid;

    /* Display whether the user is logged in or not (and display relevant links) */
    if(strcmp($uid, 'Guest') == 0) {
      echo 'Not currently logged in (Guest).<br><br>';
      echo '<a href = "login.html">Click here to log in</a><br><br>';
      echo '<a href = "contactus.html">Click here to contact us!</a><br><br>';

    } 
    else {
      echo 'Logged in as '.$uid.'<br><br>';
      echo '<a href="logout_process.php">Click here to sign out </a><br><br>';
      // This allmessages.php will be making a query to connect to the database and make a query for all messages.
      echo '<a href="allmessages.php">Click here to view all messages!</a><br><br>';
      echo '<a href="forum.html">Click here to add a new message!</a><br><br>';
      echo '<a href = "contactus.html">Click here to contact us!</a><br><br>';
    }
?>
  </body>
</html>