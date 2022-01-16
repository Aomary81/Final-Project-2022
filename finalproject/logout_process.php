<?php
    /*This clears the session variables*/
    session_start();

    $_SESSION['uid'] = 'Guest';
    header('Location: log_status.php');
?>