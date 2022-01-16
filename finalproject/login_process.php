<?php
    error_reporting(0);

    /*check for empty first...*/
    if(empty($_POST['username'])) {
      echo "You left username blank!";
      exit();
    }

    if(empty($_POST['password'])) {
      echo "You left password blank!";
      exit();
    }

    // Retrieve form data into PHP variables
    $uid = $_POST['username'];
    $pass = $_POST['password'];

    /* establish database connection */
    $servername = "localhost";
    $username = "root";
    $password = "password";
    $dbname = "MyDatabase";

    // Establish the connection to the database
    $mysqli = new mysqli($servername, $username, $password, $dbname);

    // check connection
    if ($mysqli -> connect_errno) {
      echo 'Failed to connect to MySQL: '.$mysqli -> connect_error;
      exit();

    }

    else {
      echo 'Database successfully connected! <br>';
    }
/**************************Database successfully connected!*******************************************/
 
    // Select the data from Accounts table
    $sql = sprintf("SELECT * FROM Accounts WHERE Userid = '%s'", $uid);
      
    // Push the query
    $result = $mysqli -> query($sql);
    
    if($result -> num_rows > 0) {
      while($row = $result -> fetch_assoc()) {
        $uid_ref = $row['Userid'];
        $pass_ref = $row['Password'];
      }
    }

    else {
      echo 'No specified username found!<br>';
    }
      
    // $uid = strtolower($uid);
    /* Validate the username */
    if(strcmp($uid, $uid_ref) != 0) {
      echo 'This is an invalid username and/or password';
      header('Refresh:3; URL=login.html');
      exit();
    }
    
    /* Validate the password */
    /* Do NOT convert this string to a common case.  passwords should be case
      sensitive*/
      
    if(strcmp($pass, $pass_ref) != 0) {
      echo 'This is an invalid username and/or password';
      header('Refresh:3; URL=login.html');
      exit();
    }
/**************************Working!!!!!!*******************************************/

    // successful login
    session_start();
    $_SESSION['uid'] = $uid;
    echo $uid;

    // Clost the connection to the datbase
    $mysqli -> close();

    // Establish a redirect to the login status page
    header('Location: log_status.php');
/**************************Working!!!!!!*******************************************/
?>
