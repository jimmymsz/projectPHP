<?php
	//variables
	$name = $_POST['name'];
	$email = $_POST['email'];
	$feedback = $_POST['feedback'];

	$content = 'User name : '.$name."\n"
				.'User e-mail : '.$email."\n"
				."Comments : \n".$feedback."\n";

	//insert to database?
?>

<!DOCTYPE html>
<html>
<head>
	<title>abc - Feedback Submitted</title>
</head>
<body>
	<h1>Feedback submitted</h1>
	<p>Your feedback has been sent.
		<br><br>
		You will be redirected soon.
	</p>
</body>
</html>