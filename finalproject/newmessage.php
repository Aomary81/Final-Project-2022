<?php
	$servername = "localhost";
	$username = "root";
	$password = "password";
	$dbname = "MyDatabase";

	$mysqli = new mysqli($servername, $username, $password, $dbname);	

	if($mysqli -> connect_errno) {
		echo 'Failed to connect to MySQL Database: '.$mysqli -> connect_error;
		exit();
	}
	else{
		echo 'Database successfully connected!<br>';
	}

	if(empty($_POST['message'])) {
		echo 'You left the message box empty!';
		exit();
	}

	$post = addslashes($_POST['message']);
/**************************************Working!!!!*****************************************/

	$sql = 'CREATE TABLE IF NOT EXISTS Messages (MessageNumber INT AUTO_INCREMENT PRIMARY KEY, Message VARCHAR(500))';
	// Further Note: How to get this to interact with the Comments section

	// $sql = 'CREATE TABLE Accounts (AccountNumber INT, Userid VARCHAR(40), Password VARCHAR(40), Name VARCHAR(40), Email VARCHAR(60))';
  
	// Push the query through using PHP
	$result = $mysqli -> query($sql);

	// Display the results
	if($result) {
		// Successful creation of the table
		echo 'Table created successfully<br>';
	}
	else {
		// Error with creating the table
		echo 'Error Creating Table. '.$mysqli->error.'<br>';
	}
/**************************************Working!!!!*****************************************/

	$sql = "INSERT INTO Messages (Message) VALUES('$post')";

	// Push the query
	$result = $mysqli -> query($sql);

	// Display the result to allow for possible redirect to the login page
	if($result) {
		echo 'Insert into table successfully! Waiting to redirect..<br>';
		header('Refresh:3; URL=log_status.php');
	}

	// Display the error of the result
	else {
		echo 'Error inserting into Table. '.$mysqli -> error.'<br>';
	}

	// Close the connection to the MySQL Database
	$mysqli -> close();

	// Show that the post has been added to the database
	echo $post;
/**************************************Working!!!!*****************************************/
?>