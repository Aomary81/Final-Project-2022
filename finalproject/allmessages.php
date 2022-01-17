<html>
    <h2>Welcome to our Forum! Here is the history of all the messages posted in the forum!<br><br></h2>
    <body style = "background-color: silver">

<!--Clickable link to return to the main page!--> 
<a href="log_status.php">Click here to return to the main page!</a><br><br>

<?php
    // Set up the database login info and connect to the MySQL Database
	$servername = "localhost";
	$username = "root";
        $password = "password";
	$dbname = "MyDatabase";
        $number = 1;

	// Establish the connection with the database
	$mysqli = new mysqli($servername, $username, $password, $dbname);

	// Check the connection
	if($mysqli -> connect_errno) {
   		echo 'Failed to connect to MySQL: '.$mysqli -> connect_error;
   		exit();
	}
    else {}

    // SQL to select everything from the messages table 
    $sql = sprintf("SELECT * FROM Messages");
    $result = $mysqli -> query($sql);

    // Check to view if the queries got pushed to the database
    if($result -> num_rows > 0){
        while($row = $result -> fetch_assoc()){
          $message_num_ref = $row['MessageNumber'];
          $message_ref = $row['Message'];
          echo $message_num_ref.'        ';
          echo $message_ref.'<br>';

          // Loop for the comments based on the CommentNumber
          $sql2 = 'CREATE TABLE IF NOT EXISTS Comments (CommentNumber INT AUTO_INCREMENT PRIMARY KEY, MessageNumber INT, Comment VARCHAR(200))';
          $results2 = $mysqli -> query($sql2);
          $sql1 = sprintf("SELECT * FROM Comments WHERE MessageNumber = $number");
          $results = $mysqli -> query($sql1);
          while($row = $results -> fetch_assoc()){
              $comment_num_ref = $row['CommentNumber'];
              $comment_ref = $row['Comment'];
              echo '-------'.$comment_ref.'<br>';
          }// end while
        
        // Increment the Message Number 
        $number++;
?>
        <!-- Implement the comments boxes for each of the posts created on the forum, accompanied by a submit button !-->
        <form method = "post" action = "comments.php">
        <label for="comment">Comment: (max. 200 characters)</label><br>
        <textarea id = "comment" name = "comment" maxlength = "200" style = "width: 200px; height: 50px"></textarea><br><br>
        <input type = 'hidden'  name = 'var' value = '<?php echo "$message_num_ref";?>'/>
        <input type="submit" value = "Post comment">
        </form>

    <?php
        }// end while 
    }// end if

    // Print message of no messages being found. 
    else {
        echo 'No specified message found!<br>';
    }
    ?>

    </body>
</html>