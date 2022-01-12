<?php
  error_reporting(0);
  /*check for empty first...*/
  if(empty($_POST['username'])){
    echo "You left username blank!";
    exit();
  }
  if(empty($_POST['password'])){
    echo "You left password blank!";
    exit();
  }

  $uid = $_POST['username'];
  $pass = $_POST['password'];

  //test values
  $sql_create = 'CREATE TABLE Accounts(AccountNumber INT(11), Userid VARCHAR(25), Password VARCHAR(25), Name VARCHAR(25), Email VARCHAR(25))';
  $sql_insert = "INSERT INTO Accounts (AccountNumber, Userid, Password, Name, Email)
  VALUES
    (1, 'root', 'admin', 'administrator', admin@admin.net),
    (2, 'yanlin', 'p4ssw0rd', 'yan lin', 'yan@yan.com'),
    (3, 'notyan', 'password', 'not yan', 'notyan@yan.com')";

  /*establish database connection*/
  $servername = "localhost";
  $username = "root";
  $password = "password";
  $dbname = "MyDatabase";

  $mysqli = new mysqli($servername, $username, $password, $dbname);

#  $mysqli -> query($sql);
  //check connection
  if ($mysqli -> connect_errno){
    echo 'Failed to connect to MySQL: '.$mysqli -> connect_error;
    exit();
  }
  else{
    echo 'Database successfully connected! <br>';
  }
/*
  //create table UserList
  if($mysqli -> query($sql_create) == true){
    echo "Table creation successful!";
  }
  else {
    echo "Failed to create table!";
  }
  //insert user rows
  if($mysqli -> query($sql_insert) == true){
    echo "Row insertion successful!";
  }
  else {
    echo "Failed to insert new rows!";
  }
*/

 
  //insert username and passwords 

  $sql = sprintf("SELECT * FROM Accounts WHERE Userid = '%s'", $uid);
  $result = $mysqli->query($sql);

  if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
      $uid_ref = $row['Userid'];
      $pass_ref = $row['Password'];
    }
  }

  else {
    echo 'no results in table!<br>';
  }
  
  $uid = strtolower($uid);
  if(strcmp($uid, $uid_ref) != 0){
    echo 'This is an invalid username and/or password';
    exit();
  }
  
  /*validate the password*/
    /* do NOT convert this string to a common case.  passwords should be case
      sensitive*/
  if(strcmp($pass, $pass_ref) != 0){
    echo 'This is an invalid username and/or password';
    exit();
  }
   
  //successful login
  session_start();
  $_SESSION['uid'] = $uid;
  echo $uid;
  $mysqli->close();
  header('Location: log_status.php');
?>
