<?php
    // Set up the database login info and connect to the MySQL Database
    $servername = "localhost";
    $username = "root";
    $password = "password";
    $dbname = "MyDatabase";

    $mysqli = new mysqli($servername, $username, $password, $dbname);	

    if($mysqli -> connect_errno) {
    echo 'Failed to connect to MySQL Database: '.$mysqli -> connect_error;
      exit();
    }

    else {
      echo 'Database successfully connected!<br>';
    }

    if(empty($_POST['comment'])) {
      echo 'You left the message box empty!';
      // exit();
    }

    $post = addslashes($_POST['comment']);
    $message_num = $_POST['var'];

    // Create a SQL query to insert data into the Accounts table 
    $sql = "INSERT INTO Comments (MessageNumber, Comment) VALUES('$message_num', '$post')";

    // Push the query
    $result = $mysqli -> query($sql);

    // Display the result to allow for possible redirect to the login page
    if($result) {
      echo 'Insert into table successfully! Waiting to redirect..<br>';
      header('Refresh:3; URL=allmessages.php');
    }

    // Display the error of the result
    else {
      echo 'Error inserting into Table. '.$mysqli -> error.'<br>';
    }

    // Close the connection to the MySQL Database
    $mysqli -> close();

    // Show that the post has been added to the database
    echo $post;
?>