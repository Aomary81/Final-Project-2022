<?php
	// Check for empty input
	if(empty($_POST['userid'])) {
		// Give rhe message to the user
		echo 'You left your User name blank!';
		// Exit function to exit the current script
		exit();
	}
	if(empty($_POST['pass'])) {
		echo 'You left your Password blank!';
		exit();
	}
	if(empty($_POST['name'])) {
		echo 'You left your name blank!';
		exit();
	}
	if(empty($_POST['receiver'])) {
		echo 'You left your E-mail blank!';
		exit();
	}

	// Retrieve the form data into PHP variables
	$user = $_POST['userid'];
	$user = trimming($user);
	$pass = $_POST['pass'];
	$pass = trimming($pass);
	$name = $_POST['name'];
	$name = trimming($name);
	$email = $_POST['receiver'];
	$email = trimming($email);
	$id_num = 0;

	// Validate email address
	if(strpos($email, '@') !== false && strpos($email, '.') !== false) {}
	else{
		echo 'You entered '.$email.' which is not a valid email address';
		exit();
	}

	// Set up the database login info and connect to the MySQL Database
	$servername = "localhost";
	$username = "root";
    $password = "password";
	$dbname = "MyDatabase";

	// Establish the connection with the database
	$mysqli = new mysqli($servername, $username, $password, $dbname);

	// Check the connection
	if($mysqli -> connect_errno) {
   		echo 'Failed to connect to MySQL: '.$mysqli -> connect_error;
   		exit();
	}else{
		echo 'Database successfully connected!<br><br>';
	}

	// Create a SQL query to create the table for accounts on the forum project
	$sql = 'CREATE TABLE IF NOT EXISTS Accounts (AccountNumber INT, Userid VARCHAR(40), Password VARCHAR(40), Name VARCHAR(40), Email VARCHAR(60))';

	// Push the query through using PHP
	$result = $mysqli -> query($sql);

	// Display the results
	if($result) {
		// Successful creation of the table
		echo 'Table created successfully<br>';
	}
	else{
		// Error with creating the table
		echo 'Error Creating Table. '.$mysqli -> error.'<br>';
	}
	
	// Display the user account being processed to the database
    echo $user;

	$sql = "SELECT Userid FROM Accounts";
	$result = $mysqli -> query($sql);
	if($result -> num_rows > 0){
          while($row = $result -> fetch_assoc()) {
			$uid_ref = $row["Userid"];
			if(strcmp($user, $uid_ref) == 0){
				echo 'Username already Exists<br>';
				echo '<a href = "accountcreation.html">Try Again!</a><br><br>';
				exit();
            }
            else{}
		}
	}

	// Create a SQL query to display the account number from the Accounts table 
	$sql = "SELECT AccountNumber FROM Accounts";

	// Push the query
	$result = $mysqli -> query($sql);

	// Display the result of the account number
	if($result -> num_rows > 0) {
		while($row = $result -> fetch_assoc()) {
			$id_num = $row["AccountNumber"];
		}
	}
	
	// No results displayed
	else {
		echo "0 results";
	}

	// Increment the account IDs 
	$id_num++;

	// Create a SQL query to insert data into the Accounts table 
	$sql = "INSERT INTO Accounts (AccountNumber, Userid, Password, Name, Email)VALUES('$id_num', '$user','$pass','$name','$email')";

	// Push the query
 	$result = $mysqli -> query($sql);

	 // Display the result to allow for possible redirect to the login page
	if($result) {
          echo 'Insert into table successfully! Waiting to redirect..<br>';
          header('Refresh:3; URL=login.html');
	}

	// Display the error of the result
	else {
		echo 'Error inserting into Table. '.$mysqli -> error.'<br>';
	}

	// Close the connection to the MySQL Database
	$mysqli -> close();

	// Function to check for invalid input data
	function trimming ($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>