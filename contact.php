<?php
	if(empty($_POST['name'])) {
		echo 'You left your Name blank!';
		exit();
	}
	
	if(empty($_POST['receiver'])) {
		echo 'You left your E-mail blank!';
		exit();
	}
	if(empty($_POST['subject'])) {
		echo 'You left your Subject blank!';
		exit();
	}
	$name = $_POST['name'];
	$name = trimming($name);
	$email = $_POST['receiver'];
	$email = trimming($email);
	$subject = $_POST['subject'];
	$subject = trimming($subject);
	$msg = $_POST['message'];
	$msg = trimming($msg);
	$msg = $msg.'<br><br>'.'Return Email Address: '.$email;

	if(strpos($email, '@') !== false && strpos($email, '.') !== false){}
	else{
		echo 'You entered '.$email.' which is not a valid email address';
		exit();
	}

	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		echo 'Invalid Email Format!';
		exit();
	}
	$gor_mail = 'GatesofRam@gmail.com';

	if(mail($gor_mail,$subject,$msg)){
		echo 'Mail Succesfully Sent';
		exit();
	}
	else{
		echo 'Error Sending Email';
		exit();
	}


	function trimming ($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>