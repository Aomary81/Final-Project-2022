<?php
	if(empty($_POST['userid'])) {
		echo 'You left your User name blank!';
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

	$user = $_POST['userid'];
	$user = trimming($user);
	$pass = $_POST['pass'];
	$pass = trimming($pass);
	$name = $_POST['name'];
	$name = trimming($name);
	$email = $_POST['receiver'];
	$email = trimming($email);
	$id_num = 0;

	if(strpos($email, '@') !== false && strpos($email, '.') !== false){}
	else{
		echo 'You entered '.$email.' which is not a valid email address';
		exit();
	}

	$servername = "localhost";
	$username = "root";
	$password = "password";
	$dbname = "MyDatabase";

	$mysqli = new mysqli($servername, $username, $password, $dbname);

	if($mysqli -> connect_errno){
   		echo 'Failed to connect to MySQL: '.$mysqli -> connect_error;
   		exit();
	}else{
		echo 'Database successfully connected!<br><br>';
	}
/*
	$sql = 'CREATE TABLE Accounts (AccountNumber INT, Userid VARCHAR(40), Password VARCHAR(40), Name VARCHAR(40), Email VARCHAR(60))';
	$result = $mysqli->query($sql);
	if($result){
		echo 'Table created successfully<br>';
	}
	else{
		echo 'Error Creating Table. '.$mysqli->error.'<br>';
	}
*/	
	$sql = "SELECT Userid FROM Accounts";
	$result = $mysqli->query($sql);
	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			$uid_ref = $row["userid"];
			if(strcmp($user, $uid_ref) == 0){}
			else{
				echo 'Username already Exists<br>';
				echo '<a href = "accountcreation.html">Try Again!</a><br><br>';
				exit();
			}
		}
	}
	$sql = "SELECT AccountNumber FROM Accounts";
	$result = $mysqli->query($sql);
	
	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			$id_num = $row["AccountNumber"];
		}
	}
	else{
		echo "0 results";
	}
	$id_num++;

	$sql = "INSERT INTO Accounts (AccountNumber, Userid, Password, Name, Email)VALUES('$id_num', '$user','$pass','$name','$email')";
 	$result = $mysqli->query($sql);
	if($result){
		echo 'Insert into table successfull<br>';
	}
	else{
		echo 'Error inserting into Table. '.$mysqli->error.'<br>';
	}

	$mysqli->close();

	function trimming ($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>